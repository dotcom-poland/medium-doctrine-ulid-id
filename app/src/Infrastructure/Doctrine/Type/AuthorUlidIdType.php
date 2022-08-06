<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use App\Infrastructure\Doctrine\Entity\AuthorUlidId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Uid\Ulid;

final class AuthorUlidIdType extends Type
{
    private const NAME = 'author_ulid_id';

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL([
            'length' => '26',
            'fixed' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?AuthorUlidId
    {
        if ($value instanceof AuthorUlidId) {
            return $value;
        }

        if (!\is_string($value)) {
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['string', AuthorUlidId::class]);
        }

        try {
            return new AuthorUlidId(new Ulid($value));
        } catch (\InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, $this->getName(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if ($value instanceof AuthorUlidId) {
            return $value->getValue();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), [AuthorUlidId::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
