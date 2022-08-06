<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Entity;

use App\Domain\Authors\Core\AuthorIdentifierInterface;
use App\Domain\Authors\Core\AuthorInterface;
use App\Domain\Authors\Core\EmailInterface;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @ORM\Entity()
 * @ORM\Table("author")
 */
class Author implements AuthorInterface
{
    use EntityTrait;

    /**
     * @ORM\Column(name="author_id", type="author_ulid_id", unique=true)
     */
    private AuthorIdentifierInterface $authorId;

    /**
     * @ORM\Embedded(class=Email::class, columnPrefix="email_")
     */
    private Email $email;

    /**
     * @ORM\Column(name="display_name", type="string", length=100)
     */
    private string $displayName;

    public function __construct(AuthorIdentifierInterface $authorId, Email $email, string $displayName)
    {
        Assert::notEmpty($displayName);
        Assert::maxLength($displayName, 100);

        $this->authorId = $authorId;
        $this->email = $email;
        $this->displayName = $displayName;
    }

    public function getIdentifier(): AuthorIdentifierInterface
    {
        return $this->authorId;
    }

    public function getEmail(): EmailInterface
    {
        return $this->email;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }
}
