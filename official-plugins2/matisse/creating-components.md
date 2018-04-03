# Creating Components

<!-- toc -->

### Implementing your own components

Each component tag is converted into an instance of a corresponding PHP class. When the template is rendered, each class instance is responsible for generating an HTML representation of the corresponding component, together with optional \(embedded or external\) javascript code and stylesheet references or embedded CSS styles.

##### Minimal component example

This is the smallest, simplest component that you may implement:

```php
use Matisse\Components\Base\Component;

class HelloWorld extends Component
{
  protected function render ()
  {
    echo "Hello World!";
  }
}
```

You would call this component from a template like this:

```html
<HelloWorld/>

or

<HelloWorld></HelloWorld>
```

which would render:

```html
Hello World!

or

Hello World!
```

##### Minimal component with a property

Let's make our component's output text parameterizable:

```php
use Matisse\Components\Base\Component;
use Matisse\Properties\Base\ComponentProperties;

class MessageProperties extends ComponentProperties
{
  public $value = '';
}

class Message extends Component
{
  const propertiesClass = TextProperties::class;

  protected function render ()
  {
    echo $this->props->value;
  }
}
```

You would call this component from a template like this:

```html
<Message value="some text"/>

or

<Message>
  <Value>some other text</Value>
</Message>
```

which would render:

```html
some text

or

some other text
```



