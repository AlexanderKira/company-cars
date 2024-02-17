<?php

namespace App\Models;

use Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Car extends Model
{
    use AsSource;
    use HasFactory;
    use Filterable;

    protected $fillable = [
        "id",
        "model",
        'chauffeur',
        'booking_status',
        'comfort_category_id'
    ];

    public function comfortCategory(): BelongsTo
    {
        return $this->belongsTo(ComfortCategory::class);
    }

    public function carBookings(): BelongsTo
    {
        return $this->belongsTo(CarBooking::class);
    }

    protected static function newFactory(): CarFactory
    {
        return CarFactory::new();
    }
}
