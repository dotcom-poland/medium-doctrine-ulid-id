<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Doctrine\Entity;

use App\Infrastructure\Doctrine\Entity\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testNotPossibleToCreateWithInvalidAddress(): void
    {
        $this->expectExceptionMessageMatches('/e-mail/');

        new Email('invalid@');
    }

    public function testItIsStringable(): void
    {
        $email = new Email('john.foo@email.local');

        self::assertSame('john.foo@email.local', (string)$email);
    }
}
