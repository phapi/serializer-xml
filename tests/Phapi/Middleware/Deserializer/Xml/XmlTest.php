<?php

namespace Phapi\Tests\Middleware\Deserializer\Xml;

use Phapi\Middleware\Deserializer\Xml\Xml;
use PHPUnit_Framework_TestCase as TestCase;

/**
* @coversDefaultClass \Phapi\Middleware\Deserializer\Xml
*/
class XmlTest extends TestCase {

    public function testConstruct()
    {
        $deserializer = new Xml();
        $xml_string = "<breakfast_menu>
<food>
<name>Belgian Waffles</name>
<price>$5.95</price>
<description>Two of our famous Belgian Waffles with plenty of real maple syrup</description>
<calories>650</calories>
</food>
<food>
<name>Strawberry Belgian Waffles</name>
<price>$7.95</price>
<description>Light Belgian waffles covered with strawberries and whipped cream</description>
<calories>900</calories>
</food>
</breakfast_menu>";

        $expected = [
            'food' => [
                [
                    'name' => 'Belgian Waffles',
                    'price' => '$5.95',
                    'description' => 'Two of our famous Belgian Waffles with plenty of real maple syrup',
                    'calories' => 650
                ],
                [
                    'name' => 'Strawberry Belgian Waffles',
                    'price' => '$7.95',
                    'description' => 'Light Belgian waffles covered with strawberries and whipped cream',
                    'calories' => 900
                ]
            ]
        ];

        $this->assertEquals($expected, $deserializer->deserialize($xml_string));
    }

    public function testException()
    {
        $deserializer = new Xml();
        $input = "<breakfast_menu>
<food>
<name>Belgian Waffles</name>
<price>$5.95</price>
<description>Two of our famous Belgian Waffles with plenty of real maple syrup</description>
<calories>650
</food>
<food>
<name>Strawberry Belgian Waffles</name>
<price>$7.95</price>
<description>Light Belgian waffles covered with strawberries and whipped cream</description>
<calories>900</calories>
</food>
</breakfast_menu>";

        $this->setExpectedException('\Phapi\Exception\BadRequest', 'Could not deserialize body (XML)');
        $deserializer->deserialize($input);
    }
}
