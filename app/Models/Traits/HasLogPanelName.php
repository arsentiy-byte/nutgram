<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait HasLogPanelName
{
    /**
     * @param string $custom
     * @param bool $withKey
     * @return string
     */
    public function getCustomLogPanelName(string $custom, bool $withKey = true): string
    {
        return $withKey ? sprintf('%s #%d', $custom, $this->getKey()) : $custom;
    }

    /**
     * @param string $attribute
     * @param bool $withKey
     * @return string|null
     */
    public function getLogPanelName(string $attribute, bool $withKey = true): ?string
    {
        /** @var string|null $title */
        $title = $this->getAttribute($attribute);

        if (empty($title)) {
            return null;
        }

        return $withKey ? sprintf('%s #%d', $title, $this->getKey()) : $title;
    }
}
