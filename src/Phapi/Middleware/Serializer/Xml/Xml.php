<?php

namespace Phapi\Middleware\Serializer\Xml;

use Phapi\Exception\InternalServerError;
use Phapi\Serializer\Serializer;


/**
 * Class XML
 *
 * Middleware that serializes the response body to XML
 *
 * @category Phapi
 * @package  Phapi\Middleware\Serializer\Xml
 * @author   Peter Ahinko <peter@ahinko.se>
 * @license  MIT (http://opensource.org/licenses/MIT)
 * @link     https://github.com/phapi/serializer-xml
 */
class Xml extends Serializer
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
     * Serialize body to Yaml
     *
     * @param array $unserializedBody
     * @return string
     * @throws InternalServerError
     */
    public function serialize(array $unserializedBody = [])
    {
        // creating object of SimpleXMLElement
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><response></response>");

        // Disable errors
        libxml_use_internal_errors(true);

        // function call to convert array to xml
        $this->arrayToXML($unserializedBody, $xml);

        // Create xml string
        $xmlString = $xml->asXML();

        // Check for errors
        if (count(libxml_get_errors()) > 0) {
            // Clear errors
            libxml_clear_errors();
            // Reset error handling
            libxml_use_internal_errors(false);

            throw new InternalServerError('Could not serialize content to XML');
        }

        return $xmlString;
    }

    /**
     * Convert array to xml
     *
     * @param $input
     * @param $xml
     */
    private function arrayToXML($input, $xml)
    {
        foreach ($input as $key => $value) {
            if (is_array($value)) {
                $key = is_numeric($key) ? "item$key" : $key;
                $subNode = $xml->addChild("$key");
                $this->arrayToXML($value, $subNode);
            } else {
                $key = is_numeric($key) ? "item$key" : $key;
                $xml->addChild("$key", "$value");
            }
        }
    }
}
