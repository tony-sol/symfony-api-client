<?php

declare(strict_types=1);

namespace ApiClient\Exception;

class BaseException extends \Exception
{
    /**
     * BaseException constructor
     *
     * @param string     $message  Exception message.
     * @param \Throwable $previous Previous exception.
     */
    public function __construct(string $message, \Throwable $previous)
    {
        parent::__construct($message, $this->code, $previous);
    }
}
