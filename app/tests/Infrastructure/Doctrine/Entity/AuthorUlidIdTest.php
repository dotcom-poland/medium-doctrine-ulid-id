<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Doctrine\Entity;

use App\Infrastructure\Doctrine\Entity\AuthorUlidId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Ulid;

final class AuthorUlidIdTest extends TestCase
{
    public function testIsEqual(): void
    {
        $id1 = new AuthorUlidId(new Ulid());
        $id2 = new AuthorUlidId(Ulid::fromString($id1->getValue()));

        self::assertTrue($id1->isEqual($id2));
    }

    public function testIsNotEqual(): void
    {
        $id1 = new AuthorUlidId(new Ulid());
        $id2 = new AuthorUlidId(new Ulid());

        self::assertFalse($id1->isEqual($id2));
    }

    public function testItIsPrintable(): void
    {
        $id = new AuthorUlidId(new Ulid());

        self::assertNotEmpty((string) $id);
    }
}
