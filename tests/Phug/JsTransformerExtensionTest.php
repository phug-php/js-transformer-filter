<?php

namespace Phug\Test;
use JsTransformer\JsTransformer;
use NodejsPhpFallback\NodejsPhpFallback;
use Phug\JsTransformerExtension;
use Phug\JsTransformerFilter;

/**
 * @coversDefaultClass \Phug\JsTransformerExtension
 */
class JsTransformerExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::getTransformer
     */
    public function testGetTransformer()
    {
        $extension = new JsTransformerExtension();
        $get1 = $extension->getTransformer();
        $get2 = $extension->getTransformer();

        self::assertInstanceOf(JsTransformer::class, $get1);
        self::assertSame($get1, $get2);
    }

    /**
     * @covers ::getOptions
     */
    public function testGetOptions()
    {
        $extension = new JsTransformerExtension();

        $resolver = $extension->getOptions()['filter_resolvers']['jsTransformer'];

        self::assertSame(null, $resolver('less'));

        NodejsPhpFallback::installPackages(['jstransformer-less']);

        $filter = $resolver('less');

        self::assertInstanceOf(JsTransformerFilter::class, $filter);

        self::assertSame("a{color:red}\n", $filter->parse("a {\n  color: red;\n}\n", ['compress' => true]));
    }
}
