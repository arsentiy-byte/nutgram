<?php

declare(strict_types=1);

namespace App\Telegram\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat as ChatType;

/**
 * @property int $chat_id
 * @property string $type
 * @property string|null $username
 * @property array $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|array<array-key, Message> $messages
 */
final class Chat extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'tg_chats';

    /**
     * @var string
     */
    protected $primaryKey = 'chat_id';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'type',
        'username',
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
     * @param ChatType $chat
     * @return self
     */
    public static function updateOrCreateFromType(ChatType $chat): self
    {
        /** @var self $self */
        $self = self::query()
            ->updateOrCreate([
                'chat_id' => $chat->id,
                'type' => $chat->type,
                'username' => $chat->username,
            ], [
                'data' => $chat->toArray(),
            ]);

        return $self;
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'chat_id', 'chat_id');
    }
}
