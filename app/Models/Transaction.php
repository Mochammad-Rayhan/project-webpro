<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'order_id',
        'id_admin',
        'total',
        'status',
    ];  

    public function user()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_admin');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
