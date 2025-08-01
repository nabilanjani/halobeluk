<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'name',
        'description',
        'owner_name',
        'phone_number',
        'address',
        'image_path',
        'category',
        'established_date',
        'link',
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
