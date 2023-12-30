<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Box extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'team_id',
        'shelf_id'
    ];  
    
    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }  
    
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }  
}
