<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_date',
        'due_date',
        'customer_email',

        'total_qty',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'sub_total_amount',
        'note'
    ];
}
