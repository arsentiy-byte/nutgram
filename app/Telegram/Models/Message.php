<?php

declare(strict_types=1);

namespace App\Telegram\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $message_id
 * @property int|null $from_id
 * @property int|null $chat_id
 * @property string|null $text
 * @property Carbon $date
 * @property array $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User|null $from
 * @property-read Chat|null $chat
 */
final class Message extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'tg_messages';

    /**
     * @var string
     */
    protected $primaryKey = 'message_id';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'message_id',
        'from_id',
        'chat_id',
        'text',
        'date',
        'data',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
        'date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_id', 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'chat_id', 'chat_id');
    }
}
