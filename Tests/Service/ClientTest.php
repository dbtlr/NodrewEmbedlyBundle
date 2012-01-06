<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Service;

use Nodrew\Bundle\EmbedlyBundle\Service\Client,
    Nodrew\Bundle\EmbedlyBundle\Connection\CurlConnection;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Service\Client::__construct
     */
    public function testConstructWillExplodeIfChildClientDoesNotHaveAUriDefined()
    {
        $this->setExpectedException('LogicException');
        $client = new BadMockClient('keynum', 4, array('wmode' => 'window'));
    }    
    
    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Service\Client::fetch
     */
    public function testWillBuildObjectsThroughTheFactoryBasedOnTypeGiven()
    {
        $client = new MockClient('keynum', 4, array('wmode' => 'window'));
        $client->setCurlConnection($this->getMockConn(array('type' => 'link')));

        $result = $client->fetch('http://www.example.com');

        $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\LinkResponse', get_class($result));
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Service\Client::fetch
     */
    public function testWillBuildMultipleObjectsThroughTheFactoryWhenReturnedMultipleResults()
    {
        $client = new MockClient('keynum', 4, array('wmode' => 'window'));
        $client->setCurlConnection($this->getMockConn(array(array('type' => 'link'), array('type' => 'video'))));

        $result = $client->fetch('http://www.example.com');

        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\LinkResponse', get_class($result[0]));
        $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\VideoResponse', get_class($result[1]));
    }
    

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Service\Client::fetch
     */
    public function testWillReturnErrorObjectIfErrorCodeReturned()
    {
        $client = new MockClient('keynum', 4, array('wmode' => 'window'));
        $client->setCurlConnection($this->getMockConn(404));

        $result = $client->fetch('http://www.example.com');

        $this->assertEquals('Nodrew\\Bundle\\EmbedlyBundle\\Model\\Response\\ErrorResponse', get_class($result));
        $this->assertEquals(404, $result->getCode());
        $this->assertEquals('Not Found', $result->getMessage());
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Service\Client::fetch
     */
    public function testWillSetSingleUrlProperly()
    {
        $client = new MockClient('keynum', 4, array('wmode' => 'window'));
        $conn   = $this->getMockConn(array('type' => 'link'));
        $client->setCurlConnection($conn);

        $result = $client->fetch('http://www.example.com');

        $this->assertEquals('http://www.example.com/blah?key=keynum&url=http%3A%2F%2Fwww.example.com&format=json&wmode=window&nostyle=0&autoplay=0&videosrc=0&words=50', $conn->path);
    }

    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Service\Client::fetch
     */
    public function testWillSetMultipleUrlsProperly()
    {
        $client = new MockClient('keynum', 4, array('wmode' => 'window'));
        $conn   = $this->getMockConn(array('type' => 'link'));
        $client->setCurlConnection($conn);

        $result = $client->fetch(array('http://www.example.com', 'http://www.example1.com'));

        $this->assertEquals('http://www.example.com/blah?key=keynum&urls=http%3A%2F%2Fwww.example.com,http%3A%2F%2Fwww.example1.com&format=json&wmode=window&nostyle=0&autoplay=0&videosrc=0&words=50', $conn->path);
    }

    /**
     * Get the mock curl object, loaded with the given array of data as JSON.
     *
     * @param array $returnData
     */
    protected function getMockConn($returnData)
    {
        if (is_array($returnData)) {
            $returnData = json_encode($returnData);
        }

        $conn = new MockCurlConnection;
        $conn->return = $returnData;

        return $conn;
    }
}

/**
 * A mock client WITH the CLIENT_URL defined as required.
 */
class MockClient extends Client
{
    const CLIENT_URI = 'http://www.example.com/blah?%s';
}

/**
 * A mock client WITHOUT the CLIENT_URL defined as required.
 */
class BadMockClient extends Client
{

}

/**
 * Mock object to be used instead of the Curl Connection class that is normally required.
 */
class MockCurlConnection extends CurlConnection
{
    public $return = '';
    public $path;
    public function request($path)
    {
        $this->path = $path;

        // To mock out what happens when a particular status code is returned.
        if (is_int($this->return)) {
            return $this->buildErrorReturn($this->return);
        }

        return $this->return;
    }
}
