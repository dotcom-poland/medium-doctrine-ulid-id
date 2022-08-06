<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Entity;

use App\Domain\Authors\Core\EmailInterface;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @psalm-immutable
 *
 * @ORM\Embeddable()
 */
final class Email implements EmailInterface
{
    /**
     * @ORM\Column(name="address", type="string", length=255)
     */
    private string $address;

    public function __construct(string $email)
    {
        Assert::email($email);
        Assert::maxLength($email, 255);

        $this->address = $email;
    }

    public function getValue(): string
    {
        return $this->address;
    }

    public function __toString(): string
    {
        return $this->address;
    }
}
