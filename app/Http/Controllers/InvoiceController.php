<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Mail\CustomerInvoiceConfirmationEmail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::get();
        return Inertia::render('Invoices/Index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextInvoiceId = Invoice::max('id') + 1;
        $products = Product::get(['id', 'title', 'price']);
        return Inertia::render('Invoices/Create', compact('nextInvoiceId', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        DB::beginTransaction();

        // some extra calculation for invoice properties
        $total_amount = $request->collect('items')->map(function ($item) {
            return $item['qty'] * $item['unit_price'];
        })->sum();

        $discount_amount = $request->get('discount');
        $tax_amount = $request->get('tax');
        $sub_total_amount = ($total_amount - $discount_amount) + $tax_amount;

        // create Invoice
        $invoice = Invoice::query()->create([
            'invoice_date' => $request->get('invoiceDate'),
            'due_date' => $request->get('dueDate'),
            'customer_email' => $request->get('customer_email'),

            'total_amount' => $total_amount,
            'discount_amount' => $discount_amount,
            'tax_amount' => $tax_amount,
            'sub_total_amount' => $sub_total_amount,

            'note' => $request->get('note'),
        ]);

        // attach Invoice Items
        foreach ($request->get('items') as $item) {
            $invoice->invoiceItems()->create([
                'product_id' => $item['product_id'],
                'unit_price' => $item['unit_price'],
                'qty' => $item['qty'],
                'total_amount' => $item['unit_price'] * $item['qty'],
            ]);
        }
        // calculate total Items


        DB::commit();

        DB::rollback();

        try {
            Mail::to($invoice->customer_email, 'John Doe')->send(new CustomerInvoiceConfirmationEmail($invoice));
        } catch (\Throwable $th) {
            dd('mail not send, it might invalid mail configuration');
        }

        return to_route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        if (request()->has('print')) {
            $invoice->load('invoiceItems.product');
            return Inertia::render('Invoices/Print', compact('invoice'));
        }

        return Inertia::render('Invoices/Show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
