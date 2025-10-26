<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'registration_date',
        'profile_picture',
    ];

    protected $hidden = ['password'];

    public function wishlistItems()
    {
        return $this->hasMany(\App\Models\Wishlist::class, 'user_id', 'user_id');
    }

    public function libraryEntries()
    {
        return $this->hasMany(\App\Models\LibraryEntry::class, 'owner_id', 'user_id');
    }
}
