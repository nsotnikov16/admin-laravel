<?php

declare(strict_types=1);

namespace Admin\Form\Domain\Dto;

use Admin\Shared\Domain\Dto\Dto;

class FormFieldDto extends Dto
{
    const TYPE_TEXT = 'text';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_HTML = 'html';

    public string $type;
    public string $name;
    public string $label;
    public ?string $value;
    public ?string $placeholder = '';
    public int $textareaRows = 10;
    public bool $line = false;

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function setPlaceholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function setTextareaRows(int $textareaRows): self
    {
        $this->textareaRows = $textareaRows;
        return $this;
    }

    public function setLine(bool $line): self
    {
        $this->line = $line;
        return $this;
    }
}
