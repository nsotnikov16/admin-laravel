<?php

declare(strict_types=1);

namespace Admin\Shared\Domain\Dto;

use Admin\Shared\Domain\Dto\Dto;

class ResultDto extends Dto
{
    public bool $success = false;
    public ?string $error;
    public ?string $message;
    public ?array $data;
    public ?string $redirect;

    public function setSuccess(bool $boolean): self
    {
        $this->success = $boolean;
        return $this;
    }

    public function setError(string $error): self
    {
        $this->error = $error;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function setRedirect(string $redirect): self
    {
        $this->redirect = $redirect;
        return $this;
    }
}
