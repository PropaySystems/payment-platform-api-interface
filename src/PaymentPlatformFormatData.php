<?php

namespace PropaySystems\PaymentPlatformApiInterface;

class PaymentPlatformFormatData
{
    public function __construct(protected mixed $data)
    {
        //
    }

    /**
     * @throws \Exception
     */
    public function get(): mixed
    {
        return json_decode($this->data) ?? $this->error($this->data);
    }

    /**
     * @throws \Exception
     */
    public function getAttributes(): mixed
    {
        return json_decode($this->data)->data->attributes ?? null;
    }

    /**
     * @throws \Exception
     */
    public function status(): int
    {
        return json_decode($this->data)->data->status_code ?? 404;
    }

    /**
     * @throws \Exception
     */
    public function getString(): mixed
    {
        return $this->data ?? $this->error($this->data);
    }

    /**
     * @throws \Exception
     */
    public function getArray(): mixed
    {

        return ! is_null(json_decode($this->data)) ? json_decode($this->data, true) : $this->error($this->data);
    }

    /**
     * @throws \Exception
     */
    protected function error($message): array
    {
        throw new \Exception($message);
    }
}
