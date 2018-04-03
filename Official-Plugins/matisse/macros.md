# Macros

<!-- toc -->

Components can also be defined with pure markup via template files, without any PHP code. Those templates are conceptually similar to parametric macros, so they are called _macro components_, or simply _macros_.

Macros are a **web designer's best friend**, as they allow the creation of simple components without the need for programming skills.

##### A more advanced component

This template defines a macro component that implements a customisable panel:

```html
<Macro name=Panel defaultParam=content>
  <Param name=type type=string default="box-solid box-default"/>
  <Param name=title type=string/>
  <Param name=content type=content/>
  <Param name=footer type=content/>

  <div class="panel box {@type}">
    <If {@title}>
      <div class="box-header with-border">
        <h3 class="box-title">{@title}</h3>
      </div>
    </If>
    <div class="box-body">
      {@content|*}
    </div>
    <If {@footer}>
      <div class="box-footer">
        {@footer|*}
      </div>
    </If>
  </div>
</Template>
```

You can then create instances of this component like this:

```html
<Panel type="info" title="My title">
  <h1>Welcome</h1>
  <p>Some text here...</p>
  <Footer>Some footer text...</Footer>
</Panel>
```

When rendered, the template will generate the following HTML markup:

```html
<div class="panel box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">My title</h3>
  </div>
  <div class="box-body">
    <h1>Welcome</h1>
    <p>Some text here...</p>
  </div>
  <div class="box-footer">
    Some footer text...
  </div>
</div>
```



