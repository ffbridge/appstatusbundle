# AppStatusBundle

Symfony2 bundle for simple app supervision

## Installation 

### Step 1: Setting up the bundle
========================================

#### - Install AppStatsBundle

First add kilix composer repository to your composer.json

```json

"repositories": [
        {
            "type": "composer",
            "url": "http://composer.kilix.net"
        }
    ]

```

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

### Step 2: Using the bundle
=========================================

#### - Creating Statuses

Create a service as follows. The service needs to implement the `Kilix\AppStatusBundle\Status\StatusInterface` **interface**

```php
<?php
//...
use Kilix\AppStatusBundle\Status\StatusInterface;

class YourStatusService implements StatusInterface
{
    // return boolean if the app element you are testing is ok or not
    public function getStatus()
    {
        //... your tests 
        return true; 
    }
    
    //return the name of the app element you are testing
    public function getName()
    {
        return 'YourStatus'; 
    }
}
```

Declare your service as follows 

```yml
services:
    your_status_service:
        class: Company\Bundle\Service\YourStatusService
        tags:
            - { name: kilix_app_status.status }
```
Finally access your app using the url `/app_status/{status_name}` where `status_name` is optional.

