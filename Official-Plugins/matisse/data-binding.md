# Data Binding

<!-- toc -->

Data from a view model or from component properties can be automatically applied to specific places on the template. This is called "binding" data to the template.

To bind data, you use "data binding expressions", which are enclosed in brackets.

##### Example

```html
<SomeComponent value={record.name}/>
```

If you need to insert a binding expression on a javascript block containing brackets, you'll need to always insert a line break after each bracket that is **not** part of a binding expression.

##### Example

```html
<script>
if (x>y) {
  alert("Hello {name}, how are you?");
}
</script>
```

> In this example, the bracket on the first line of script is not mistaken for a binding expression delimiter, as it is immediately followed by a line break.

#### Expression syntax

The syntax for expressions differs from PHP expressions. For instance, accessing properties of an object or array is done with the dot operator, instead of the `[]` or `->` operators.

Expressions can also define sequences of filters for applying multiple transformations to a value. The pipe operator `|` delimits the filters on an expression. The value from the leftmost part of the expression will flow from left to right, the result of the previous filter being fed to the next one. Filters may also have additional arguments.

##### Example

```html
<SomeComponent value={record.date|datePart|else 'No date'}/>
```

#### (Un)escaping output

Binding expressions always HTML-encode (escape) their output, for security reasons.

But if you really need to output raw markup, you can use the `*` filter.

##### Example

```html
<div>{content|*}</div>
```

#### Binding component properties

On composite components (those having their own templates), you can bind to the properties of the component (that owns the template) using the `@` operator.

##### Example

```html
<SomeComponent value={@someProperty}/>
```

You'l see more examples of this type of binding on the "Macros" chapter.

