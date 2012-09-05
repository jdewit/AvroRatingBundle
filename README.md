AvroRatingBundle
-----------------
Add a star rating to any object. 


Status
------
- A work in progress
- Currently only works with MongoDB

Requirements
------------
- <a href="http://github.com/FriendsOfSymfony/FOSUserBundle">FOSUserBundle</a>
- <a href="http://jquery.com">JQuery</a>

Installation
------------
### Download AvroRatingBundle using composer

Add AvroRatingBundle in your composer.json:

```js
{
    "require": {
        "avro/rating-bundle": "*"
    }
}
```
Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update avro/rating-bundle
```

### Enable the bundle in the kernel:

``` php
// app/AppKernel.php
new Avro\RatingBundle\AvroRatingBundle
```

### Add Resources
Add CSS
``` html
{% stylesheets output='css/compiled/app.css' filter='cssrewrite, less, ?yui_css'
...
    'bundles/avrorating/css/avro-rating.css'
...
%}
<link rel="stylesheet" href="{{ asset_url }}" type="text/css" media="screen" />
{% endstylesheets %}
```
Add JS
``` html
{% javascripts output='js/compiled/app.js' filter='?yui_js'
...
    'bundles/avrorating/js/avro-rating.js'
...
%}
    <script type="text/javascript" src="{{ asset_url }}"></script>
{% endjavascripts %}

```

Dump your assets and watch
``` bash
$ php app/console assets:install --symlink=true

$ php app/console assetic:dump --watch --force 
```

Configuration
-------------
No configuration is necessary but does come with some options
that allow you to customize it

``` yaml
avro_rating:
    template: 'AvroRatingBundle:Rating:rating.html.twig
    star_count: 5
    min_role: ROLE_USER
```



Usage
-----

Add the rating reference to the object you want to rate


``` php
<?php
// src/Acme/ProductBundle/Document/Product.php

namespace Acme\ProductBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Product
{
    ...

    /**
     * @ODM\ReferenceOne(targetDocument="Avro\RatingBundle\Document\Rating", cascade={"all"})
     */
    protected $rating;

    /**
     * Set rating
     *
     * @param Avro\RatingBundle\Document\Rating $rating
     * @return Product
     */
    public function setRating(\Avro\RatingBundle\Document\Rating $rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * Get rating
     *
     * @return Avro\RatingBundle\Document\Rating $rating
     */
    public function getRating()
    {
        return $this->rating;
    }
    
    ...
}
```

Render the rating in your view

``` html
{{ avro_rating(product.rating) }}
```

And that's it!

TODO
----
1. ORM support
2. Add configuration

