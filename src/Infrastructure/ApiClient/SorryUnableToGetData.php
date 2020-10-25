<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

use function get_class;
use function gettype;

final class SorryUnableToGetData extends Exception
{
    /** @var mixed[] */
    private array $context;

    /** @param mixed[] $context */
    public function __construct(string $message, array $context)
    {
        parent::__construct($message);
        $this->context = $context;
    }

    public static function connectionException(GuzzleException $exception): self
    {
        return new self('Unable to connect to Buienradar API', ['exception' => $exception->getMessage()]);
    }

    public static function invalidStatusCode(ResponseInterface $response): self
    {
        return new self(
            'Invalid status code returned from Buienradar API',
            [
                'statusCode' => $response->getStatusCode(),
                'body' => $response->getBody()->getContents(),
            ]
        );
    }

    public static function deserializationError(Throwable $exception): self
    {
        return new self(
            'Error while deserializing Buienradar API response',
            [
                'exception' => $exception->getMessage(),
            ]
        );
    }

    /** @param mixed $result */
    public static function unexpectedDeserializationResult($result): self
    {
        $type = gettype($result);
        if ($type === 'object') {
            $type = get_class($result);
        }

        return new self('Unexpected result from deserializing Buienradar API response', ['result_type' => $type]);
    }

    /** @return mixed[] */
    public function getContext(): array
    {
        return $this->context;
    }
}
