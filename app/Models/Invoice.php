<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

        'total_amount',
        'tax_amount',
        'discount_amount',
        'sub_total_amount',
        'note'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['total_qty'];

    /**
     * Get the total_qty
     *
     * @param  string  $value
     * @return string
     */
    public function getTotalQtyAttribute($value)
    {
        return $this->invoiceItems()->sum('qty');
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
