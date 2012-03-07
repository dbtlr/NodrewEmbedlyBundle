<?php

namespace Nodrew\Bundle\EmbedlyBundle\Tests\Service;

use Nodrew\Bundle\EmbedlyBundle\Service\Client,
    Nodrew\Bundle\EmbedlyBundle\Connection\CurlResponse,
    Nodrew\Bundle\EmbedlyBundle\Connection\CurlConnection,
    Nodrew\Bundle\EmbedlyBundle\Model\Response\MappedResponseAbstract,
    Nodrew\Bundle\EmbedlyBundle\Factory\ResponseFactoryInterface;

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

        $this->assertEquals('link', $result->getType());
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
        $this->assertEquals('link', $result[0]->getType());
        $this->assertEquals('video', $result[1]->getType());
    }


    /**
     * @covers Nodrew\Bundle\EmbedlyBundle\Service\Client::fetch
     */
    public function testWillReturnErrorObjectIfErrorCodeReturned()
    {
        $client = new MockClient('keynum', 4, array('wmode' => 'window'));
        $client->setCurlConnection($this->getMockConn('WTF ERROR!!', array('http_code' => 404)));

        $result = $client->fetch('http://www.example.com');

        $this->assertEquals('error', $result->getType());

        $props = $result->getUnknownProperties();

        $this->assertEquals(404, $props['error_code']);
        $this->assertEquals('Not Found', $props['error_message']);
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

        $this->assertEquals('http://www.example.com/blah?key=keynum&url=http%3A%2F%2Fwww.example.com&format=json&wmode=window&nostyle=&autoplay=&videosrc=&words=50', $conn->path);
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

        $this->assertEquals('http://www.example.com/blah?key=keynum&urls=http%3A%2F%2Fwww.example.com,http%3A%2F%2Fwww.example1.com&format=json&wmode=window&nostyle=&autoplay=&videosrc=&words=50', $conn->path);
    }

    /**
     * Get the mock curl object, loaded with the given array of data as JSON.
     *
     * @param array $returnData
     */
    protected function getMockConn($returnData, $info = array())
    {
        if (is_array($returnData)) {
            $returnData = json_encode($returnData);
        }

        $conn = new MockCurlConnection;
        $conn->return = new CurlResponse($returnData, $info);

        return $conn;
    }
}

/**
 * A mock client WITH the CLIENT_URL defined as required.
 */
class MockClient extends Client
{
    const CLIENT_URI = 'http://www.example.com/blah?%s';

    /**
     * {@inheritdoc}
     */
    protected function getResponseFactory()
    {
        return new MockFactory;
    }
}

/**
 * A mock client WITHOUT the CLIENT_URL defined as required.
 */
class BadMockClient extends Client
{

    /**
     * {@inheritdoc}
     */
    protected function getResponseFactory()
    {
        return new MockFactory;
    }
}

class MockFactory implements ResponseFactoryInterface
{
    public function buildResponse($embedlyResponse)
    {
        $response = new ResponseMock();
        $response->map($embedlyResponse);

        return $response;
    }
}



/**
 * Mock class for Nodrew\Bundle\EmbedlyBundle\Model\Response\MappedResponseAbstract
 */
class ResponseMock extends MappedResponseAbstract
{
    public $fieldMappings = array();

    public function getType()
    {
        return isset($this->unknownProperties['type']) ? $this->unknownProperties['type'] : 'mock';
    }

    protected function getFieldMappings()
    {
        return $this->fieldMappings;
    }
}

/**
 * Mock object to be used instead of the Curl Connection class that is normally required.
 */
class MockCurlConnection extends CurlConnection
{
    public $return;
    public $path;
    public function request($path)
    {
        $this->path = $path;
        return $this->return;
    }
}
