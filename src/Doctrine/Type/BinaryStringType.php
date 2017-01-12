<?php declare(strict_types = 1);

namespace Cmnty\PushBundle\Doctrine\Type;

use Cmnty\Push\Crypto\BinaryString;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class BinaryStringType extends Type
{
    const TYPE = 'binary_string';

    /**
     * {@inheritdoc}
     *
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getBinaryTypeDeclarationSQL([
            'length' => $fieldDeclaration['length'],
            'fixed' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     *
     * @return BinaryString|null
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof BinaryString) {
            return $value;
        }

        try {
            return new BinaryString($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     *
     * @return string
     *
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof BinaryString) {
            return $value->getRawBytes();
        }

        try {
            return (new BinaryString($value))->getRawBytes();
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return self::TYPE;
    }

    /**
     * {@inheritdoc}
     *
     * @param AbstractPlatform $platform
     *
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
