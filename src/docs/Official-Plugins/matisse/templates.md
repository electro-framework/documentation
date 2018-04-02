# Templates and Components

<!-- toc -->

#### Templates

Matisse templates are HTML text files where, besides common HTML tags \(always lower cased\), special tags, beginning with a capital letter, specify dynamic components.

##### Example

```html
<h1>Some HTML text</h1>
<form>
  <Input name=field1 value={myVar}/>
  <For each=record of={data}>
    <Header><ul></Header>
    <li>Item {record.name}</li>
    <Footer></ul></Footer>
    <Else>There are no items.</Else>
  </For>
</form>
```

> **Note:** when writing templates, HTML markup should be written in HTML 5 syntax, while component tags must be written in XML syntax. This means tags must always be closed, even if the tag has no content \(you can use the self-closing tag syntax: `<Component/>`\). Unlike XML though, attribute values are not required to be enclosed in quotes.

#### Components

On the example above, `Input` is a component, not the common `input` HTML element. It is processed on the server, and it generates HTML markup that will replace its tag on the resulting HTML document.

`For` is another component. It repeats a block of markup for each record on a list \(array\) of records.  
When there is data, `For` writes an header \(if specified\), followed by the repeatable content, followed by a footer \(if specified\).  
If there is no data, only the content of the `Else` subtag is output.

#### Attributes

Component properties are represented by HTML tag attributes \(ex. the `each` and `of` attributes of the `For` tag\).

You should **use attributes for defining properties having scalar values** \(ex: string or numeric values\).

The syntax for an attribute is `name="value"`, `name='value'` or `name=value` \(the later can be used only if the value has no spaces on it\).

Boolean attributes \(those with `true` or `false` values\) can be defined without specifiyng the values. Ex: `<Tag readonly/>` for `true` and just `<Tag/>` \(with the attribute missing\) for `false`.

#### Slots \(subtags\)

Slots are properties of the enclosing component that are written as subtags; which allows complex content to be specified..

Slot tags, like component tags, are also capitalized, but they do not represent components.

In the example above, the optional content parts of the `For` component are defined with slots: the `Header`, `Footer` and `Else` tags.

> **Use slots when the property value is HTML markup**. Notice that the markup content may define additional components which may, in turn, have slots.

#### Mixed HTML and XML markup

Again on the example above, notice how the `<ul>` tag is only closed inside the `<Footer>` tag, seemingly violating the correct HTML tag nesting structure of the template. In reality, the template is perfectly valid and so is the generated HTML output. This happens because, for Matisse, all lower cased HTML tags are simply raw text, without any special meaning. All text lying between component tags \(those beginning with a capital letter\) is converted into as few as possible Text components.

So, the real DOM \(as parsed by Matisse\) for the example above is \(in pseudo-code\):

```html
<Text value="<h1>Some HTML text</h1><form>"/>
<Input name=field1 value={myVar}/>
<For each=record of={data} header="<ul>" footer="</ul>" else="There are no items.">
  <Text value="<li>Item "/>
  <Text value={record.name}/>
  <Text value="</li>"/>
</For>
<Text value="</form>"/>
```



