<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'nama_barang',
        'dokumentasi',
        'jumlah',
        'expired_at',
    ];

    public function barang(){
        return $this->hasMany(Barang::class);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['expired_at'];
    
}
