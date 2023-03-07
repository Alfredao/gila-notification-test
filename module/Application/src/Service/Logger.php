<?php
declare(strict_types=1);

namespace Application\Service;

use Application\Service\Logger\Type;
use Monolog;
use Monolog\Handler;
use Monolog\Level;
use Psr\Log\LoggerInterface;
use Stringable;

/**
 * Class Logger
 *
 * @package Application\Service
 */
class Logger implements LoggerInterface
{

    private Monolog\Logger $logger;
    protected static bool $registeredExceptionHandler = false;

    /**
     * Logger constructor.
     *
     * @param \Application\Service\Logger\Type $type
     */
    public function __construct(Type $type)
    {
        // Create the logger
        $this->logger = new Monolog\Logger($type->value);
        $this->logger->pushHandler(new Handler\StreamHandler('php://stdout', Level::Debug));
    }

    /**
     * System is unusable.
     *
     * @param string|\Stringable $message
     * @param array $context
     * @return void
     */
    public function emergency(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->emergency($message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string|\Stringable $message
     * @param array $context
     * @return void
     */
    public function alert(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->alert($message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string|\Stringable $message
     * @param array $context
     * @return void
     */
    public function critical(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->critical($message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function error(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->error($message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function warning(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->warning($message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function notice(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->notice($message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function info(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->info($message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function debug(string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->debug($message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, string|Stringable $message, array $context = [])
    : void
    {
        $this->logger->log($level, $message, $context);
    }

    /**
     * Register logging system as an exception handler to log PHP exceptions
     *
     * @link http://www.php.net/manual/en/function.set-exception-handler.php
     * @param Logger $logger
     * @return bool
     */
    public static function registerExceptionHandler(self $logger)
    : bool
    {
        // Only register once per instance
        if (static::$registeredExceptionHandler) {
            return false;
        }

        set_exception_handler(static function ($exception) use ($logger) {
            $logMessages = [];

            do {
                $logMessages[] = [
                    'message' => $exception->getMessage(),
                    'extra'   => [
                        'file'  => $exception->getFile(),
                        'line'  => $exception->getLine(),
                        'trace' => $exception->getTrace(),
                    ],
                ];

                $exception = $exception->getPrevious();
            } while ($exception);

            foreach (array_reverse($logMessages) as $logMessage) {
                $logger->error($logMessage['message'], $logMessage['extra']);
            }
        });

        static::$registeredExceptionHandler = true;

        return true;
    }

    /**
     * Unregister exception handler
     *
     * @return void
     */
    public static function unregisterExceptionHandler()
    : void
    {
        restore_exception_handler();

        static::$registeredExceptionHandler = false;
    }
}
