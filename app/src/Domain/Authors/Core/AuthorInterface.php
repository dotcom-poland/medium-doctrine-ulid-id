<?php

declare(strict_types=1);

namespace App\Domain\Authors\Core;

interface AuthorInterface
{
    public function getIdentifier(): AuthorIdentifierInterface;

    public function getEmail(): EmailInterface;

    public function getDisplayName(): string;
}
