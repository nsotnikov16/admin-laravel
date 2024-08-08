<?php

declare(strict_types=1);

namespace Admin\Breadcrumbs\Domain\Dto;

use Admin\Shared\Domain\Collection\Collection;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;

class BreadcrumbCollectionDto extends Collection
{
    public function type(): string
    {
        return BreadcrumbDto::class;
    }
}
