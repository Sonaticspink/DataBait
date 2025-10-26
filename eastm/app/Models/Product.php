<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // table name
    protected $table = 'products';

    // custom PK
    protected $primaryKey = 'product_id';

    // no timestamps in table
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'developer',
        'publisher',
        'release_date',
        'price',
        'cover_image',
        'product_genres',
    ];

    // relationships
    public function wishlistedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id', 'product_id', 'user_id');
    }
}
