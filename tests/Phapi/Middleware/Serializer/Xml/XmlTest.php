<?php

namespace Phapi\Tests\Middleware\Serializer\Xml;

use Phapi\Middleware\Serializer\Xml\Xml;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @coversDefaultClass \Phapi\Middleware\Serializer\Xml
 */
class XmlTest extends TestCase {

    public function testConstruct()
    {
        $serializer = new Xml();
    
        $input = [
            "users" => [
                "id" => 1,
                "username" => "phapi",
                "name" => "Phapi"
            ],
            "count" => 8,
            "test" => ["one","two"]
        ];

        $expected = '<?xml version="1.0"?>
<response><users><id>1</id><username>phapi</username><name>Phapi</name></users><count>8</count><test><item0>one</item0><item1>two</item1></test></response>
';

        $this->assertEquals($expected, $serializer->serialize($input));
    }

    public function testException()
    {
        $serializer = new Xml();
        $this->setExpectedException('\Phapi\Exception\InternalServerError', 'Could not serialize content to XML');

        $serializer->serialize(["\xB1\x31"]);
    }

}
