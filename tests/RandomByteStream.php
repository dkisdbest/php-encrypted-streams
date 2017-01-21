<?php
namespace Jsq\EncryptionStreams;

use GuzzleHttp\Psr7\PumpStream;
use GuzzleHttp\Psr7\StreamDecoratorTrait;
use Psr\Http\Message\StreamInterface;

class RandomByteStream implements StreamInterface
{
    use StreamDecoratorTrait;

    /**
     * @param int $maxLength
     */
    public function __construct($maxLength)
    {
        $this->stream = new PumpStream(function ($length) use (&$maxLength) {
            $length = min($length, $maxLength);
            $maxLength -= $length;
            return openssl_random_pseudo_bytes($length);
        });
    }
}