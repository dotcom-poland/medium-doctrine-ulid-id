<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Entity;

use App\Domain\SharedKernel\Id\IdentifierInterface;
use Symfony\Component\Uid\Ulid;

/**
 * @psalm-immutable
 */
trait IdentifierUlidTrait
{
    private string $value;

    public function __construct(Ulid $ulid)
    {
        /** @psalm-suppress ImpureMethodCall */
        $this->value = $ulid->toBase32();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEqual(IdentifierInterface $identifier): bool
    {
        return $this->value === $identifier->getValue();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
