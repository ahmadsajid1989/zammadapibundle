# Zammad API Client for Symfony application

This client can be used to access the API of the open source helpdesk [Zammad](http://www.zammad.org) via Symfony. This application is just a wrapper of
[Zammad API Client](https://github.com/zammad/zammad-api-client-php/blob/master/README.md)


Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require ahmadsajid1989/zammadApiBundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.


### Requirements

the API client needs PHP 5.6 or newer.

### Integration into your project
Add the following to the "require" section of your project's composer.json file:
```json
"ahmadsajid1989/zammadApiBundle": "dev-master"
```

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new ahmadsajid1989\ZammadApiBundle\ZammadApiBundle(),
        );

        // ...
    }

    // ...
}
```

Update your config file with the following settings:

### app/config/config.php

```
zammad_api:
    url: 'https://localhost/zammad
    username: 'username'
    password: 'password'
    debug: 'false'
```


