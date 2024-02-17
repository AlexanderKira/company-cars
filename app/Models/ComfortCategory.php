<?php

namespace App\Models;

use Database\Factories\ComfortCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ComfortCategory extends Model
{
    use AsSource;
    use HasFactory;
    use Filterable;

    protected $fillable = [
        "id",
        "title",
        "description",
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    protected static function newFactory(): ComfortCategoryFactory
    {
        return ComfortCategoryFactory::new();
    }
}
