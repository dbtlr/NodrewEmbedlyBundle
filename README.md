Embedly Bundle for Symfony2
================================

For use with the Embedly service at: http://www.embedly.com

APIs Supported:
- [oEmbed](http://embed.ly/docs/endpoints/1/oembed): Complete
- [Preview](http://embed.ly/docs/endpoints/1/preview): In Development
- [Objectify](http://embed.ly/docs/endpoints/2/objectify): In Development

__Under Development__

Installation Instructions
=========================

Add these blocks to the following files

*deps*

```
[NodrewEmbedlyBundle]
    git=http://github.com/nodrew/NodrewEmbedlyBundle.git
    target=/bundles/Nodrew/Bundle/EmbedlyBundle
```

*app/autoload.php*

```
$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    ...
    'Nodrew'   => __DIR__.'/../vendor/bundles',
    ...
));
```

*app/AppKernel.php*

```
public function registerBundles()
{
    $bundles = array(
        // System Bundles
        ...
        new Nodrew\Bundle\EmbedlyBundle\NodrewEmbedlyBundle(),
        ...
    );
}
```

*app/config/config.yml*

```
nodrew_embedly:
    key:   [your api key]
```

Using Embedly's oEmbed Service
=============

To use Embedly to get the information about a single url, pass fetch() a url like:

```php
$client   = $container->get('nodrew_embedly.oembed.client');
$response = $client->fetch('http://example.com/path');

$response; // Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface object
```

To use Embedly to return information about multiple urls, pass fetch() an array of urls like:

```php
$client   = $container->get('nodrew_embedly.oembed.client');
$response = $client->fetch(array('http://example.com/path','http://example.com/another/path'));

$response; // Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface object
```


Possible Response Objects
=========================

A subclass of the [Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ResponseInterface.php) is always expected. If one is not returned, then there was likely a problem contacting Embedly or a timeout occurred.

- [Nodrew\Bundle\EmbedlyBundle\Model\Response\LinkResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/LinkResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\PhotoResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/PhotoResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\VideoResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/VideoResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\RichResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/RichResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\ErrorResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ErrorResponse.php)

If the [ErrorResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ErrorResponse.php) object is returned, then it will contain an error message and error code describing as best as possible what happened. Usually this happens when a 404 is returned by the target url and Embedly is unable to fetch information about it. It may also contain a 500 type error if there is an issue with the target path's server.

Optional Configuration
======================

These options may be added to the configuration. The timeout is how long you will wait for Embedly to return. If you plan to use the multiple URL feature, I suggest upping this number, as Embedly is very fast on single URLs, especially highly trafficked ones. However, the more obscure the URL, and the more you provide, the longer they will take to process.

For the rest of the options, see the [Embedly query argument documentation](http://embed.ly/docs/endpoints/arguments) for a full reference of what they do. Note: there are a couple options that were removed, simply because they did not make sense in the context of this bundle. If you feel like one of those is needed, then please let me know through the bug reports and I'll see what I can do to incorporate it.

*app/config/config.yml*

```
nodrew_embedly:
    timeout:   3
    options:
        width:      ~
        maxwidth:   ~
        maxheight:  ~
        wmode:      opaque
        nostyle:    ~
        autoplay:   ~
        videosrc:   ~
        words:      50
        chars:      ~
```