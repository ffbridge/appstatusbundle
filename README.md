# AppStatusBundle

Symfony2 bundle for simple app supervision

## Installation 

### Step 1: Setting up the bundle
========================================

#### - Install AppStatsBundle

Simply run assuming you have installed composer.phar or composer binary:

``` bash
$ php composer.phar require kilix/appstatusbundle dev-master
```

#### - Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Kilix\AppStatusBundle\KilixAppStatusBundle(),
    );
}
```

Import the bundle routing file, you can setup any prefix you want

```yml

kilix_app_status:
    resource: "@KilixAppStatusBundle/Resources/config/routing.yml"
    prefix:   /
```