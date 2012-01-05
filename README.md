Embedly Bundle for Symfony2
================================

For use with the Embedly service at: http://www.embedly.com

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