<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modality extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Relationships
    public function machine(): HasMany
    {
        return $this->hasMany(Machine::class);
    }
}
