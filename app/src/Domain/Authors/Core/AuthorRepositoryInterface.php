<?php

declare(strict_types=1);

namespace App\Domain\Authors\Core;

/**
 * @template TObject of AuthorInterface
 */
interface AuthorRepositoryInterface
{
    /**
     * @param TObject $author
     */
    public function add(AuthorInterface $author): void;

    /**
     * @return TObject|null
     */
    public function findByEmail(string $email): ?AuthorInterface;
}
