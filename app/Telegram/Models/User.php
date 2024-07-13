<?php

declare(strict_types=1);

namespace App\Telegram\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SergiX44\Nutgram\Telegram\Types\User\User as UserType;

/**
 * @property int $user_id
 * @property string|null $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @property array $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|array<array-key, Message> $messages
 */
final class User extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'tg_users';

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'username',
        'first_name',
        'last_name',
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
     * @param UserType $user
     * @return self
     */
    public static function updateOrCreateFromType(UserType $user): self
    {
        /** @var self $self */
        $self = self::query()
            ->updateOrCreate([
                'user_id' => $user->id,
            ], [
                'username' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'data' => $user->toArray(),
            ]);

        return $self;
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'from_id', 'user_id');
    }
}
