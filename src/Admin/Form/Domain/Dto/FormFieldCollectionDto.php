<?php
declare(strict_types=1);

namespace Admin\Form\Domain\Dto;

use Admin\Shared\Domain\Collection\Collection;
use Admin\Form\Domain\Dto\FormFieldDto;

class FormFieldCollectionDto extends Collection
{
    public function type(): string
    {
        return FormFieldDto::class;
    }
}
