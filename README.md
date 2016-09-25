JSBlockBundle
=============

The Symfony JSBlockBundle gives you a chance to collect javascript across all **TWIG templates (e.g. forms)** and render them at the end of your layout (or anywhere you want them).

[![Build Status](https://travis-ci.org/Fousky/JSBlockBundle.svg?branch=master)](https://travis-ci.org/Fousky/JSBlockBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Fousky/JSBlockBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Fousky/JSBlockBundle/?branch=master)

#### 1. Install it by composer
```
composer require fousky/jsblock
```

#### 2. Register bundle in Kernel

```php
public function registerBundles()
{
    $bundles = array(
        new Fousky\JSBlockBundle\FouskyJSBlockBundle(),
        // ... your custom bundles
    );
    
    // ... your custom dev bundles
    
    return $bundles;
}
```


#### 3. Render collected javascripts to your main template

I assume you have the main template `layout.html.twig`, so add `{% jsblock 'render' %}` before closing `</body>` tag.

Of course you can put this tag anywhere you want to render collected javascripts.

```twig
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>my page</title>
</head>
<body>

<!-- APPLICATION LOGIC -->

<!-- render collected javascripts -->
{% jsblock 'render' %}

</body>
</html>
```

#### 4. Collect javascripts anywhere

Now you can collect javascripts anywhere you want.
You have to start collecting by tag: `{% jsblock 'start' %}` and close it by tag `{% jsblock 'stop' %}`.

```twig
<!-- CUSTOM LOGIC -->

<!-- need some javascript? Start rendering -->
{% jsblock 'start' %}
    <script>
        $(document).ready(function() {
            console.log('Hello from collected JSBlockBundle!');
        });
    </script>
{% jsblock 'stop' %}
<!-- and close collecting -->
```
