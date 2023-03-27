<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBelanja extends Model
{
    use HasFactory;
    /**
     * filllable
     *
     * @var array
     */
    protected $fillable = [
        'item', 'quantity', 'jumlah'
    ];
}
