### Using Eloquent

To use Eloquent, access your models as usual, but don't forget to base their classes on ` Electro\Plugins\IlluminateDatabase\BaseModel` instead of `Illuminate\Database\Eloquent\Model`.

##### Example

```php
use Electro\Plugins\IlluminateDatabase\BaseModel;

class Article extends BaseModel { }

$article = Article::find(1);
```

### Using the query builder

##### Example

```php
$this->api->query()->from('products')->where('type','box')->get();
```
or simply
```php
$this->api->table('products')->where('type','box')->get();
```

### Using the Schema builder

##### Example

```php
use Illuminate\Database\Schema\Blueprint;

$this->api->schema()->create ('news', function (Blueprint $table) {
    $table->increments ('id');
    $table->string ('title', 100);
});
```

### Using "Facades"

This plugin also emulates some common database-related Laravel facades:

- `DB::method()`     - equivalent to `$api->connection ()->method()`
- `Schema::method()` - equivalent to `$api->schema()->method()`

This way, you don't need to inject an API instance to call the query builder or the schema builder.

> **danger**
> Being an anti-pattern, global facades are **not recommended** for development with Electro.
>
> They can be useful, though, for compatibility with foreign code that uses them, or if you need to reuse code that you have written for projects based on Laravel.

Be sure to import the related namespaces before using the facades (do **not** use the original facades, it won't work).

```php
use Electro\Plugins\IlluminateDatabase\DB;
use Electro\Plugins\IlluminateDatabase\Schema;
```
