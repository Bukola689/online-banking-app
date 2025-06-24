<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, softDeletes;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'account_number',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
