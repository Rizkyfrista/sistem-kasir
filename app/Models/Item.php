<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    /**
     * filllable
     *
     * @var array
     */
    protected $fillable = [
        'nama_item', 'harga_item', 'satuan'
    ];

    public function belanjas()
    {
        return $this->belongsToMany(HeaderBelanja::class, 'detail_belanjas');
    }
}
