<?php

namespace App\core\item\app\port;

use App\core\item\app\dto\request\ConsumeitemRequest;
use App\core\item\app\dto\response\itemResponse;

interface ConsumeItem
{
    public function execute(ConsumeitemRequest $request): itemResponse;
}
