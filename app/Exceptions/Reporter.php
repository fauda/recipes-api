<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Validation\ValidationException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Reporter
{
    /**
     * A list of the exception types that should not be reported to the log.
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ValidationException::class,
    ];

    /**
     * The log implementation.
     * @var \Psr\Log\LoggerInterface
     */
    protected $log;

    public function __construct(LoggerInterface $log)
    {
        $this->log = $log;
    }

    /**
     * @param Exception $exception
     */
    public function exception(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            $this->log->error($exception);
        }
    }

    /**
     * @param Exception $exception
     * @return bool
     */
    public function shouldReport(Exception $exception) : bool
    {
        foreach ($this->dontReport as $exceptionName) {
            if ($exception instanceof $exceptionName) {
                return false;
            }
        }

        return true;
    }
}