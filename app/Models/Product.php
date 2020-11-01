<?php

namespace App\Models;

use Faker\Factory;
use App\Models\User;
use App\Models\Category;
use App\Utils\CanBeRated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, CanBeRated;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function (Product $product) {
            $faker = Factory::create();
            $product->image_url = $faker->imageUrl();
            $product->createdBy()->associate(auth()->user());
        });
    }
}
