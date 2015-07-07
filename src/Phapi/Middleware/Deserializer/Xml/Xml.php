<?php

namespace Phapi\Middleware\Deserializer\XML;

use Phapi\Serializer\Deserializer;
use Phapi\Exception\BadRequest;

/**
 * Class Deserialize XML
 *
 * Middleware that deserializes a request with a XML body.
 *
 * @category Phapi
 * @package  Phapi\Middleware\Deserializer\Xml
 * @author   Peter Ahinko <peter@ahinko.se>
 * @license  MIT (http://opensource.org/licenses/MIT)
 * @link     https://github.com/phapi/serializer-xml
 */
class Xml extends Deserializer
{

    /**
     * Valid mime types
     *
     * @var array
     */
    protected $mimeTypes = [
        'application/xml'
    ];

    /**
     * Deserialize the body
     *
     * @param $body
     * @return array
     * @throws BadRequest
     */
    public function deserialize($body)
    {
        try {
            $xml = simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOERROR);
            $array = json_decode(json_encode($xml), true);
        } catch (\Exception $e) {
            throw new BadRequest('Could not deserialize body (XML)');
        }
        return $array;
    }
}
