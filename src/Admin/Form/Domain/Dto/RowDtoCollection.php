<?php
declare(strict_types=1);

namespace Admin\Form\Domain\Dto;

use Admin\Shared\Domain\Collection\Collection;
use Admin\Form\Domain\Dto\RowDto;

class RowDtoCollection extends Collection
{
    public function type(): string
    {
        return RowDto::class;
    }
}
