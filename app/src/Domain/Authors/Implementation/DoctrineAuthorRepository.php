<?php

declare(strict_types=1);

namespace App\Domain\Authors\Implementation;

use App\Domain\Authors\Core\AuthorInterface;
use App\Domain\Authors\Core\AuthorRepositoryInterface;
use App\Infrastructure\Doctrine\Entity\Author;
use App\Infrastructure\Doctrine\Entity\Email;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @template-implements AuthorRepositoryInterface<Author>
 */
final class DoctrineAuthorRepository implements AuthorRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /** {@inheritDoc} */
    public function add(AuthorInterface $author): void
    {
        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }

    /** {@inheritDoc} */
    public function findByEmail(string $email): ?AuthorInterface
    {
        return $this->entityManager->getRepository(Author::class)
            ->findOneBy(['email.address' => $email]);
    }
}
