<?php

namespace Dynamophp\HashBundle\Factory;

use Dynamophp\Hash\Context;

class DefaultContextFactory
{
    public static function createSha256Context(int $startSelection, int $endSelection): Context
    {
        return Context::buildSha256($startSelection, $endSelection);
    }
}