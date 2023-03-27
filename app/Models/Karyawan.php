<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    /**
     * filllable
     *
     * @var array
     */
    protected $fillable = [
        'nama_karyawan', 'alamat'
    ];

    public function belanjas()
    {
        return $this->hasMany(HeaderBelanja::class, 'id_karyawan');
    }
}
