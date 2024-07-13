<?php

declare(strict_types=1);

namespace App\Telegram\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use SergiX44\Nutgram\Telegram\Types\Common\Update as UpdateType;

/**
 * @property int $update_id
 * @property array $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Update extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'tg_updates';

    /**
     * @var string
     */
    protected $primaryKey = 'update_id';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'update_id',
        'data',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @param UpdateType $update
     * @return self
     */
    public static function updateOrCreateFromType(UpdateType $update): self
    {
        /** @var self $self */
        $self = self::query()->updateOrCreate([
            'update_id' => $update->update_id,
        ], [
            'data' => $update->toArray(),
        ]);

        return $self;
    }
}
