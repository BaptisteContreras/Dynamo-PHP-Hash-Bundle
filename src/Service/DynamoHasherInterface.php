<?php

namespace Dynamophp\HashBundle\Service;

interface DynamoHasherInterface
{
    public function hash(string $value): float;
}