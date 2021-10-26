<?php

namespace Infrastructure\Persistence\Doctrine\Apartment;

use RuntimeException;
use Throwable;

class ApartmentNotFoundException extends RuntimeException
{

    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}