<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LibraryEntry extends Model
{
    protected $table = 'library';
    protected $primaryKey = 'library_id';
    public $timestamps = false;

    protected $fillable = [
        'owner_id',
        'game_id',
        'game_icon',
    ];

    public function product()
    {
        // game_id in library → product_id in products
        return $this->belongsTo(Product::class, 'game_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'user_id');
    }
}
