<?php

namespace App\Models;

use App\Enums\USState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    /** @use HasFactory<\Database\Factories\FacilityFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'facility',
        'street_address',
        'city',
        'state',
        'zip_code',
    ];

    /*
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'state' => USState::class,
            'created_at' => 'datetime',
            'deleted_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /*
     * Relationships
     */
    public function location(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function machine(): HasMany
    {
        return $this->hasMany(Machine::class);
    }
}
