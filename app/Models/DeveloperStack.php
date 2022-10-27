<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DeveloperStack extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'developer_id',
        'stack_id',
        'stack_experience',
        'is_primary',
        'created_at',
        'updated_at',
    ];

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function stack(): BelongsTo
    {
        return $this->belongsTo(Stack::class, 'stack_id');
    }
}
