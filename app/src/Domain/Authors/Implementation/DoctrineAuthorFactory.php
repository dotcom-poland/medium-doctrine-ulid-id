<?php

declare(strict_types=1);

namespace App\Domain\Authors\Implementation;

use App\Domain\Authors\Core\AuthorFactoryInterface;
use App\Domain\Authors\Core\AuthorInterface;
use App\Infrastructure\Doctrine\Entity\Author;
use App\Infrastructure\Doctrine\Entity\AuthorUlidId;
use App\Infrastructure\Doctrine\Entity\Email;
use Symfony\Component\Uid\Ulid;

final class DoctrineAuthorFactory implements AuthorFactoryInterface
{
    public function __invoke(string $displayName, string $email): AuthorInterface
    {
        $authorId = new AuthorUlidId(new Ulid());

        return new Author($authorId, new Email($email), $displayName);
    }
}
