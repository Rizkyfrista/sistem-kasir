<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderBelanja extends Model
{
    use HasFactory;
    /**
     * filllable
     *
     * @var array
     */
    protected $fillable = [
        'tanggal_belanja', 'id_karyawan', 'total_belanja'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'detail_belanjas');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
