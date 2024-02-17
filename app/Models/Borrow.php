<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc',
        'user_id',
        'sub_item_id'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            if (!$model->exists) {
                $model->uuid = (string) Uuid::uuid4();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function subitem(): BelongsTo
    {
        return $this->belongsTo(SubItem::class, 'sub_item_id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
