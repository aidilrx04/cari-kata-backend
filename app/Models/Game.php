<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $title
 * @property array $words
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Grid|null $grid
 * @method static \Database\Factories\GameFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereWords($value)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUserId($value)
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'words'];

    protected $casts = [
        "words" => "array"
    ];

    public function grid(): HasOne
    {
        return $this->hasOne(Grid::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
