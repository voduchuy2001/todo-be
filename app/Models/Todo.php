<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $table = 'todos';

    protected $fillable = [
        'name',
        'content',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'user_id');
    }
}
