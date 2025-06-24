<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, softDeletes;

     protected $guarded = [];

     protected $fillable = [
         'sender_id',
         'sender_account_id',
         'receipt_account_id',
         'reference',
         'status',
         'amount',
     ];

     protected $casts = [
         'amount' => 'decimal:4',
         'date' => 'datetime',
         'meta' => 'array',
     ];

     protected $attributes = [
         'confirmed' => false,
         'meta' => [],
     ];

     protected $hidden = [
         'created_at',
         'updated_at',
         'deleted_at',
     ];

     protected $with = [
         'sender',
         'senderAccount',
         'receiptAccount',
     ];

     protected $appends = [
         'formatted_amount',
         'formatted_date',
     ];

     public function sender()
     {
         return $this->belongsTo(User::class, 'sender_id');
     }

     public function senderAccount()
     {
         return $this->belongsTo(Account::class, 'sender_account_id');
     }

     public function receiptAccount()
     {
         return $this->belongsTo(Account::class, 'receip_account_id');
     }
}
