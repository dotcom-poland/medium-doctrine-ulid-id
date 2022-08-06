<?php

declare(strict_types=1);

namespace App\Domain\SharedKernel\Id;

/**
 * @psalm-immutable
 */
interface IdentifierInterface extends \Stringable
{
    public function getValue(): string;

    public function isEqual(IdentifierInterface $identifier): bool;
}
