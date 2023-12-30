<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Tags\HasTags;

class Item extends Model
{
    use HasFactory;
    use HasTags;
    use HasUuids;

    protected $fillable = [
        'name', 
        'description', 
        'use_quantity', 
        'quantity',
        'low_quantity',
        'datasheet_url',
        'notes',
        'user_id',
        'team_id',
        'box_id'
    ];


    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }  
    
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }  

    public function shelf()
    {
        return $this->hasOneThrough(Shelf::class, Box::class);
    }

}