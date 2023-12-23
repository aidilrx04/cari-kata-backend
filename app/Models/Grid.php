<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Grid
 *
 * @property int $id
 * @property int $game_id
 * @property int $rows
 * @property int $columns
 * @property array $grid
 * @property array $solved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Game $game
 * @method static \Database\Factories\GridFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Grid newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grid newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grid query()
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereGrid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereSolved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grid whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Grid extends Model
{
    use HasFactory;

    protected $fillable = [
        "rows", 'columns', 'grid', 'solved'
    ];

    protected $casts = [
        'solved' => 'array',
        'grid' => 'array'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
