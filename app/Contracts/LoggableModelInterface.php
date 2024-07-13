<?php

declare(strict_types=1);

namespace App\Contracts;

interface LoggableModelInterface
{
    /**
     * @return string|null
     */
    public function getLogPanelNameAttribute(): ?string;

    /**
     * @return string
     */
    public function getLogSubjectTypeAttribute(): string;
}
