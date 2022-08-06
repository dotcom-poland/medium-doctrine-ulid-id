<?php

namespace App\Domain\Authors\Core;

interface AuthorFactoryInterface
{
    public function __invoke(string $displayName, string $email): AuthorInterface;
}
