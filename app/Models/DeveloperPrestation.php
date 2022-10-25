<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeveloperPrestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'developer_id',
        'prestation_type_id',
        'description',
        'price',
        'created_at',
        'updated_at',
    ];

    public function prestation(): BelongsTo
    {
        return $this->belongsTo(PrestationType::class);
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }
}
