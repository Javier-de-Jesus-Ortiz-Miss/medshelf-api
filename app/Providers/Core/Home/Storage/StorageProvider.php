<?php

namespace App\Providers\Core\Home\Storage;

use App\Core\Home\Storage\Model\Repository\StorageRepository;
use App\Providers\CoreProvider;

class StorageProvider extends CoreProvider
{

    protected function registerRepositories(): void
    {
        $this->app->singleton(StorageRepository::class, StorageRepositoryAdapter::class);
    }
}