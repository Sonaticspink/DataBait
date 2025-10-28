<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Game extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','slug','short_description','description','cover_image','hero_image','video_url','price','is_featured'
    ];


// helper: price formatted
    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 2);
    }
}
