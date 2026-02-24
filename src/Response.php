<?php

namespace Framework;

class Response
{
    public int $responseCode;

    public string $body;

    public ?string $header;

    public function __construct(string $body = "", int $responseCode = 200, ?string $header = null)
    {
        $this->body = $body;
        $this->responseCode = $responseCode;
        $this->header = $header;
    }

    public function echo(): void
    {
        http_response_code($this->responseCode);

        if ($this->header) {
            header($this->header);
        }

        echo $this->body;
    }
}
