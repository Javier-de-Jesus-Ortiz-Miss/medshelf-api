<?php

namespace App\core\inventory\app\port;

use App\core\shared\domain\PaginationRequest;
use App\core\shared\domain\PaginationResponse;

interface ProductOnlyRead
{
    function listAll(PaginationRequest $request): PaginationResponse;
}
