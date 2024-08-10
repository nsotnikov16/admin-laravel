<?php

declare(strict_types=1);

namespace Admin\Dropdown\Domain\Dto;

use Admin\Shared\Domain\Dto\Dto;

class DropdownItemDto extends Dto
{
    public string $name;
    public string $value;
    public string $label;
    public bool $checked = false;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;
        return $this;
    }
}
