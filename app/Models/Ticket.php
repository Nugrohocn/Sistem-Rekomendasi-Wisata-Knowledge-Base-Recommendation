<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    use HasFactory;

    // Daftar atribut yang bisa diisi secara massal
    protected $fillable = ['harga', 'kategori_harga'];

    /**
     * Relasi dengan tabel places
     */
    // Model Ticket
    public function places()
    {
        return $this->hasMany(Place::class, 'tiket_id');
    }
}
