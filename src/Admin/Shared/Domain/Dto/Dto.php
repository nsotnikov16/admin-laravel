<?php

declare(strict_types=1);

namespace Admin\Shared\Domain\Dto;

use JsonSerializable;

abstract class Dto implements JsonSerializable
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function jsonSerialize(): array
    {
        $array = $this->toArray();
        foreach ($this->jsonAliases() as $from => $to) {
            if (isset($array[$from])) {
                $array[$to] = $array[$from];
                unset($array[$from]);
            }
        }
        foreach ($this->jsonHidden() as $key) {
            unset($array[$key]);
        }

        return $array;
    }

    /**
     * @return string[]
     */
    protected function jsonHidden(): array
    {
        return [];
    }

    /**
     * @return array<string, string>
     */
    protected function jsonAliases(): array
    {
        return [];
    }
}
