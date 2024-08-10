<?php

declare(strict_types=1);

namespace Admin\Dropdown\Domain\Dto;

use Admin\Shared\Domain\Collection\Collection;
use Admin\Dropdown\Domain\Dto\DropdownItemDto;

class DropdownCollectionDto extends Collection
{
    public bool $isRadio = false;
    public string $buttonText;
    public string $addClass = '';

    public function __construct(array $items = [])
    {
        parent::__construct($items);
        $checkedKey = $this->findCheckedItemKey() !== false;
        if ($checkedKey) {
            $this->setButtonText($items[$checkedKey]->label);
        } else {
            $firstItem = $this->first();
            if ($firstItem) $this->setButtonText($firstItem->label);
        }
    }

    public function type(): string
    {
        return DropdownItemDto::class;
    }

    public function setIsRadio(bool $isRadio): self
    {
        $this->isRadio = $isRadio;
        return $this;
    }

    public function setButtonText(string $buttonText): self
    {
        $this->buttonText = $buttonText;
        return $this;
    }

    public function findCheckedItemKey()
    {
        return $this->search(function ($item) {
            return $item->checked;
        });
    }
}
