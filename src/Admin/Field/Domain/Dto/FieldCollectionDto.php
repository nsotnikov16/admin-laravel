<?php
declare(strict_types=1);

namespace Admin\Field\Domain\Dto;

use Admin\Shared\Domain\Collection\Collection;
use Admin\Field\Domain\Dto\FieldDto;

class FieldCollectionDto extends Collection
{
    public function type(): string
    {
        return FieldDto::class;
    }
}
