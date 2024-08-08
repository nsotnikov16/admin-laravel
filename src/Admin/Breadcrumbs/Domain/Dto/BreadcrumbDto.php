<?php

declare(strict_types=1);

namespace Admin\Breadcrumbs\Domain\Dto;

use Admin\Shared\Domain\Dto\Dto;

class BreadcrumbDto extends Dto
{
    public string $name;
    public string $link = '';

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }
}
