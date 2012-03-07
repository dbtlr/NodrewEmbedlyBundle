<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Model;

use Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments,
    Nodrew\Bundle\EmbedlyBundle\Exception\ParameterMatchException;

class QueryArgumentsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::load
     */
    public function testModelWillLoadFromArray()
    {
        $model = new QueryArguments;
        $model->load(array(
            'key'     => 'foo',
            'url'     => 'http://www.example.com/blah?stuff',
            'wmode'   => 'transparent',
            'nostyle' => true,
        ));

        $this->assertEquals('foo', $model->getKey());
        $this->assertEquals('http://www.example.com/blah?stuff', $model->getUrl());
        $this->assertEquals('transparent', $model->getWmode());
        $this->assertEquals(true, $model->getNostyle());
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::load
     */
    public function testWillTakeArrayOfUrlsAndTurnThemIntoAString()
    {
        $model = new QueryArguments;
        $model->setUrls(array('http://www.example.com', 'http://www.example2.com'));

        $this->assertEquals('http%3A%2F%2Fwww.example.com,http%3A%2F%2Fwww.example2.com', $model->getUrls());
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::load
     */
    public function testWillConvertToAQueryParameterString()
    {
        $model = new QueryArguments;
        $model->load(array(
            'key'     => 'foo',
            'url'     => 'http://www.example.com/blah?stuff',
            'wmode'   => 'transparent',
            'nostyle' => true,
        ));

        $string = 'key=foo&url=http%3A%2F%2Fwww.example.com%2Fblah%3Fstuff&format=json&wmode=transparent&nostyle=1&autoplay=&videosrc=&words=50';
        $this->assertEquals($string, $model->toQueryString());
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::load
     */
    public function testWillKeyOnlyAcceptsString()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'key', array('string'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::load
     */
    public function testWillUrlOnlyAcceptsString()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'url', array('string'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::load
     */
    public function testWillUrlsOnlyAcceptsArray()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'urls', array('array'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setMaxwidth
     */
    public function testWillMaxWidthOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'maxwidth', array('int', 'null'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setMaxheight
     */
    public function testWillMaxHeightOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'maxheight', array('int', 'null'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setWidth
     */
    public function testWillWidthOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'width', array('int', 'null'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setWords
     */
    public function testWillWordsOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'words', array('int', 'null'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setChars
     */
    public function testWillCharsOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'chars', array('int', 'null'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setNostyle
     */
    public function testWillNostyleOnlyAcceptsBool()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'nostyle', array('bool'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setAutplay
     */
    public function testWillAutoplayOnlyAcceptsBool()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'autoplay', array('bool'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setVideosrc
     */
    public function testWillVideosrcOnlyAcceptsBool()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'videosrc', array('bool'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setFormat
     */
    public function testWillFormatMustBeOnly()
    {
        $model = new QueryArguments;
        $this->assertModelMethodIsOneOf($model, 'format', array('json', 'xml'));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments::setWmode
     */
    public function testWillWmodeMustBeOnly()
    {
        $model = new QueryArguments;
        $this->assertModelMethodIsOneOf($model, 'wmode', array('opaque', 'transparent', 'window'));
    }

    /**
     * Takes a model class and asserts that it will only accept one of the given types for the given parameter.
     *
     * @param Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments $model
     * @param string $var
     * @param array  $accepts
     */
    protected function assertModelMethodAccepts($model, $var, $accepts)
    {
        $types = array('string' => 'foo', 'int' => 123, 'float' => 1.23, 'bool' => true, 'null' => null, 'array' => array(), 'object' => new \stdClass);

        foreach ($types as $type => $example) {
            try {
                $model->load(array($var => $example));

            } catch (ParameterMatchException $e) {
                if (in_array($type, $accepts)) {
                    $this->assertFalse(true, 'The model should accept type '.$type.', but doesn\'t.');
                }

                continue;
            }

            if (!in_array($type, $accepts)) {
                $this->assertFalse(true, 'The model shouldn\'t accept type '.$type.', but does.');
            }
        }
    }

    /**
     * Takes a model class and asserts that it will only accept one of the given variables on the given parameter.
     *
     * @param Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments $model
     * @param string $var
     * @param array  $oneof
     */
    protected function assertModelMethodIsOneOf($model, $var, $oneof)
    {
        foreach ($oneof as $value) {
            try {
                $model->load(array($var => $value));

            } catch (ParameterMatchException $e) {
                $this->assertFalse(true, 'The model should accept value '.$value.', but doesn\'t.');
            }
        }

        try {
            $model->load(array($var => 'foobarblah'));

            $this->assertFalse(true, 'The model should not accept value '.$value.', but does.');

        } catch (ParameterMatchException $e) {}
    }
}