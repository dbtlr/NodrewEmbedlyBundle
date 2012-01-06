Embedly Bundle for Symfony2 
===========================

[![Travis-CI Build Status](https://secure.travis-ci.org/nodrew/NodrewEmbedlyBundle.png?branch=master)](http://travis-ci.org/#!/nodrew/NodrewEmbedlyBundle)

For use with the Embedly service at: http://www.embedly.com

APIs Supported:

- [oEmbed](http://embed.ly/docs/endpoints/1/oembed): Complete
- [Preview](http://embed.ly/docs/endpoints/1/preview): Almost Complete - Model Response Structure May Change.
- [Objectify](http://embed.ly/docs/endpoints/2/objectify): Almost Complete - Model Response Structure May Change.

__Note: The Preview and Objectify endpoints require a paid account in order to use. An error will be returned and will result in a LogicException being thrown if you try to fetch from one of these services with the free account.__

## Installation Instructions

1. Download NodrewEmbedlyBundle
2. Configure the Autoloader
3. Enable the Bundle
4. Add your Embedly provider key

### Step 1: Download NodrewEmbedlyBundle

Ultimately, the NodrewEmbedlyBundle files should be downloaded to the
`vendor/bundles/Nodrew/Bundle/EmbedlyBundle` directory.

This can be done in several ways, depending on your preference. The first
method is the standard Symfony2 method.

**Using the vendors script**

Add the following lines in your `deps` file:

```
[NodrewEmbedlyBundle]
    git=http://github.com/nodrew/NodrewEmbedlyBundle.git
    target=/bundles/Nodrew/Bundle/EmbedlyBundle
```

Now, run the vendors script to download the bundle:

``` bash
$ php bin/vendors install
```

**Using submodules**

If you prefer instead to use git submodules, then run the following:

``` bash
$ git submodule add http://github.com/nodrew/NodrewEmbedlyBundle.git vendor/bundles/Nodrew/Bundle/EmbedlyBundle
$ git submodule update --init
```

### Step 2: Configure the Autoloader

``` php
<?php
// app/autoload.php

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    // ...
    'Nodrew'   => __DIR__.'/../vendor/bundles',
));
```

### Step 3: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Nodrew\Bundle\EmbedlyBundle\NodrewEmbedlyBundle(),
    );
}
```

### Step 4: Add your Embedly provider key

``` yaml
# app/config/config.yml
nodrew_embedly:
    key:   [your api key]
```

## Usage

There are 3 client's that can be used. Each corrisponds to the Embedly endpoing of the same name:

- oEmbed:    nodrew_embedly.oembed.client
- Preview:   nodrew_embedly.preview.client
- Objectify: nodrew_embedly.objectify.client

The interface and usage for each of these is the same, so we'll be using the oEmbed interface for the usage examples.

### Fetch on a single url

``` php
<?php

$client   = $container->get('nodrew_embedly.oembed.client');
$response = $client->fetch('http://example.com/path');

$response; // Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface object
```

### Fetch for multiple urls

``` php
<?php

$client    = $container->get('nodrew_embedly.oembed.client');
$responses = $client->fetch(array('http://example.com/path','http://example.com/another/path'));

$responses; // array of Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface objects
```


## Possible Response Objects

A subclass of the [Nodrew\Bundle\EmbedlyBundle\Model\Response\ResponseInterface](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ResponseInterface.php) is always expected. If one is not returned, then there was likely a problem contacting Embedly or a timeout occurred.

If the [ErrorResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ErrorResponse.php) object is returned, then it will contain an error message and error code describing as best as possible what happened. Usually this happens when a 404 is returned by the target url and Embedly is unable to fetch information about it. It may also contain a 500 type error if there is an issue with the target path's server.

### oEmbed Responses

- [Nodrew\Bundle\EmbedlyBundle\Model\Response\LinkResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/LinkResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\PhotoResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/PhotoResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\VideoResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/VideoResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\RichResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/RichResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\ErrorResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ErrorResponse.php)

### Preview Responses

- [Nodrew\Bundle\EmbedlyBundle\Model\Response\PreviewResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/PreviewResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\ErrorResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ErrorResponse.php)

### Objectify Responses

- [Nodrew\Bundle\EmbedlyBundle\Model\Response\ObjectifyResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ObjectifyResponse.php)
- [Nodrew\Bundle\EmbedlyBundle\Model\Response\ErrorResponse](https://github.com/nodrew/NodrewEmbedlyBundle/blob/master/Model/Response/ErrorResponse.php)


## Optional Configuration

These options may be added to the configuration. The timeout is how long you will wait for Embedly to return. If you plan to use the multiple URL feature, I suggest upping this number, as Embedly is very fast on single URLs, especially highly trafficked ones. However, the more obscure the URL, and the more you provide, the longer they will take to process.

For the rest of the options, see the [Embedly query argument documentation](http://embed.ly/docs/endpoints/arguments) for a full reference of what they do. Note: there are a couple options that were removed, simply because they did not make sense in the context of this bundle. If you feel like one of those is needed, then please let me know through the bug reports and I'll see what I can do to incorporate it.

``` yaml
// app/config/config.yml
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


## TODO

- More tests
- Add objects and parsing for the Preview and Objectify factories, to process Events, Places and Images into.
