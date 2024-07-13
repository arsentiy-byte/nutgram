<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\LoggableModelInterface;
use App\Models\Traits\HasLogPanelName;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property bool $is_active
 * @property string|null $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class User extends Authenticatable implements FilamentUser, LoggableModelInterface
{
    use HasFactory;
    use HasLogPanelName;
    use HasPanelShield;
    use HasRoles;
    use LogsActivity;
    use Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active'
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'email',
                'is_active',
            ])
            ->useLogName('Resource');
    }

    /**
     * @return string|null
     */
    public function getLogPanelNameAttribute(): ?string
    {
        return $this->getLogPanelName('name', false);
    }

    /**
     * @return string
     */
    public function getLogSubjectTypeAttribute(): string
    {
        return __('filament::pages/users.title');
    }
}
