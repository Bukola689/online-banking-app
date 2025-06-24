<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
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

     public function sender()
     {
         return $this->belongsTo(User::class, 'sender_id');
     }

        public function senderAccount()
        {
            return $this->belongsTo(Account::class, 'recipient_account_id');
        }

         public function recipient()
        {
            return $this->belongsTo(User::class);
        }

        public function recipientAccount()
        {
            return $this->belongsTo(Account::class, 'recipient_account_id');
        }
}
