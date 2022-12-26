<?php

namespace Dynamophp\HashBundle\Service;

use Dynamophp\Hash\Hasher;
use Dynamophp\Hash\InvalidPrimaryHashAlgorithm;
use Dynamophp\Hash\InvalidSelectionSizeException;

class DynamoHasherSha256 implements DynamoHasherInterface
{
    public function __construct(private readonly Hasher $hasher)
    {
    }

    /**
     * @throws InvalidPrimaryHashAlgorithm
     * @throws InvalidSelectionSizeException
     */
    public function hash(string $value): float
    {
        return $this->hasher->hash($value);
    }
}
