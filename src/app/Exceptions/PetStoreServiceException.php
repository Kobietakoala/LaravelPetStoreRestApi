<?php

namespace App\Exceptions;

use Exception;

class PetStoreServiceException extends Exception
{
    public const INVALID_INPUT = 'Invalid input';
    public const PET_NOT_FOUND = 'Pet not found';
    public const INVALID_ID = 'Invalid id';
}
