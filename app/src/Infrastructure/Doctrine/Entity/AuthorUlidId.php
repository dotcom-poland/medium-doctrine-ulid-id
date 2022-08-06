<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Entity;

use App\Domain\Authors\Core\AuthorIdentifierInterface;

/**
 * @psalm-immutable
 */
final class AuthorUlidId implements AuthorIdentifierInterface
{
    use IdentifierUlidTrait;
}
