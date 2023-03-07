<?php

namespace EasySwoole\Pay\Exception;

class Exception extends \Exception
{
    private ?string $httpResponse;

    /**
     * @return string|null
     */
    public function getHttpResponse(): ?string
    {
        return $this->httpResponse;
    }

    /**
     * @param string|null $httpResponse
     */
    public function setHttpResponse(?string $httpResponse): void
    {
        $this->httpResponse = $httpResponse;
    }

}