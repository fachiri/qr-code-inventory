<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class SubItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'is_pinjamable',
        'entry_date',
        'item_id'
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

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class)
            ->withPivot('id', 'condition');
    }

    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class, 'sub_item_id');
    }
}
