<?php

namespace App\Models;

use App\Models\Ratings;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Locations;
use App\Models\Facilities;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'alamat',
        'foto',
        'kategori_id',
        'lokasi_id',
        'rating_id',
        'tiket_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function location()
    {
        return $this->belongsTo(Locations::class, 'lokasi_id');
    }

    public function rating()
    {
        return $this->belongsTo(Ratings::class, 'rating_id');
    }

    public function tiket()
    {
        return $this->belongsTo(Ticket::class, 'tiket_id');
    }


    // Pastikan method fasilitas ada
    public function fasilitas()
    {
        return $this->belongsToMany(Facilities::class, 'facility_place', 'place_id', 'facility_id');
    }

    // Method untuk handle file upload
    public function setFotoAttribute($value)
    {
        $this->attributes['foto'] = is_string($value) ? $value : $value->store('places', 'public');
    }
}
