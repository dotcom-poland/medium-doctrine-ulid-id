<?php

declare(strict_types=1);

namespace App\Domain\Authors\Core;

/**
 * @psalm-immutable
 */
interface EmailInterface extends \Stringable
{
    public function getValue(): string;
}
