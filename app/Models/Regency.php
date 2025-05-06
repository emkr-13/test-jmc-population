<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'population', 'province_id'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function getPopulationFormattedAttribute(): string
    {
        return number_format($this->population, 0, ',', '.');
    }
}
