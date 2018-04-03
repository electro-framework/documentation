## Installation

#### Server Requirements

- PHP >= 5.6
- A fully-functional installation of the Electro framework
- [Laravel's requirements](https://laravel.com/docs/5.2#server-requirements)

#### Installation

To install this plugin on your application, using the terminal, `cd` to your app's directory and type:

```bash
workman install plugin electro-modules/illuminate-database
```

> For correct operation, do not install this package directly with Composer.

## Using the plugin

First, start by injecting the plugin API into your controller (or component, command, migration, etc).

```php
use Electro\Plugins\IlluminateDatabase\DatabaseAPI;

class MyController
{
  private $api;

  function __construct (DatabaseAPI $api) {
    $this->api = $api;
  }
}
```

