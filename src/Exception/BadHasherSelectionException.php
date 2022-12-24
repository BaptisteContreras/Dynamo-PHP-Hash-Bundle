<?php

namespace Dynamophp\HashBundle\Exception;

class BadHasherSelectionException extends \Exception
{
    public function __construct(int $maxSelection)
    {
        parent::__construct(sprintf('start_selection + end_selection must be inferior or equal to %s. start_selection and end_selection must be superior or equal to zero.', $maxSelection));
    }
}