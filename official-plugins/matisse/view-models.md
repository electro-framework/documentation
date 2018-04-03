# View Models

You may bind values from a view model into your template.

For instance, given the following view model:

```php
$model = ['footerText' => 'Some footer text...'];
```

you may call the same component, defined above, like this:

```html
<Panel type="box-info" title="My title">
  <h1>Welcome</h1>
  <p>Some text here...</p>
  <Footer>{footerText}</Footer>
</Panel>
```

The resulting output would be identical to the one from the previous example.
