<?php

declare(strict_types=1);

namespace App\Tests\Domain\Authors\Implementation;

use App\Domain\Authors\Implementation\DoctrineAuthorFactory;
use PHPUnit\Framework\TestCase;

final class DoctrineAuthorFactoryTest extends TestCase
{
    private DoctrineAuthorFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new DoctrineAuthorFactory();
    }

    public function testCreate(): void
    {
        $this->expectNotToPerformAssertions();

        ($this->factory)('John Doe', 'john.doe@foo.local');
    }
}
