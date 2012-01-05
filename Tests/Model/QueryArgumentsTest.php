<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Model;

use Nodrew\Bundle\EmbedlyBundle\Model\QueryArguments,
    Nodrew\Bundle\EmbedlyBundle\Exception\ParameterMatchException;

class QueryArgumentsTest extends \PHPUnit_Framework_TestCase
{
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
    
    public function testWillTakeArrayOfUrlsAndTurnThemIntoAString()
    {
        $model = new QueryArguments;
        $model->setUrls(array('http://www.example.com', 'http://www.example2.com'));
        
        $this->assertEquals('http://www.example.com,http://www.example2.com', $model->getUrls());
    }    

    public function testWillConvertToAQueryParameterString()
    {
        $model = new QueryArguments;
        $model->load(array(
            'key'     => 'foo',
            'url'     => 'http://www.example.com/blah?stuff',
            'wmode'   => 'transparent',
            'nostyle' => true,
        ));
        
        $string = 'key=foo&url=http%3A%2F%2Fwww.example.com%2Fblah%3Fstuff&format=json&wmode=transparent&nostyle=1&autoplay=0&videosrc=0&words=50';
        $this->assertEquals($string, $model->toQueryString());
    }
    
    public function testWillKeyOnlyAcceptsString()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'key', array('string'));
    }
    
    public function testWillUrlOnlyAcceptsString()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'url', array('string'));
    }
    
    public function testWillUrlsOnlyAcceptsArray()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'urls', array('array'));
    }
    
    public function testWillMaxWidthOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'maxwidth', array('int', 'null'));
    }
    
    public function testWillMaxHeightOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'maxheight', array('int', 'null'));
    }
    
    public function testWillWidthOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'width', array('int', 'null'));
    }
    
    public function testWillWordsOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'words', array('int', 'null'));
    }
    
    public function testWillCharsOnlyAcceptsIntAndNull()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'chars', array('int', 'null'));
    }
    
    public function testWillNostyleOnlyAcceptsBool()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'nostyle', array('bool'));
    }
    
    public function testWillAutoplayOnlyAcceptsBool()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'autoplay', array('bool'));
    }
    
    public function testWillVideosrcOnlyAcceptsBool()
    {
        $model = new QueryArguments;
        $this->assertModelMethodAccepts($model, 'videosrc', array('bool'));
    }
    
    public function testWillFormatMustBeOnly()
    {
        $model = new QueryArguments;
        $this->assertModelMethodIsOneOf($model, 'format', array('json', 'xml'));
    }
    
    public function testWillWmodeMustBeOnly()
    {
        $model = new QueryArguments;
        $this->assertModelMethodIsOneOf($model, 'wmode', array('opaque', 'transparent', 'window'));
    }

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