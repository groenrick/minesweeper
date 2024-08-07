<?php

namespace Rickgroen\Minesweeper\Http\Responses;

class BaseResponse
{
    public bool $isJson = true;

    /**
     * @throws \JsonException
     */
    public function getContent(): string
    {
        return json_encode($this->getData(), JSON_THROW_ON_ERROR);
    }

    /**
     * @return mixed[]
     */
    public function getData(): array
    {
        return [];
    }

    public function getStatus(): int
    {
        return 200;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {

        return [
            'Content-Type' => $this->isJson ? 'application/json' : 'text/html',
        ];
    }

    public function send(): void
    {
        http_response_code($this->getStatus());

        foreach ($this->getHeaders() as $header => $value) {
            header("$header: $value");
        }
        echo $this->getContent();
    }
}