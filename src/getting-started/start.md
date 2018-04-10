# Start developing

### Create your main module

Electro is a highly modular framework; as such, even your application's core code must be a module (or several modules).

Modules may be **private modules**, **plugins** or **templates**.

> Read the framework's documentation for a thorough explanation about each module type.

**Before you can start developing your application, you must create, at least, one private module for it.**

Type:

```bash
workman make:module
```

Follow the interactive instructions. Workman will generate a ready to use scaffold with routing, navigation and module configuration, which you may use as a base for a general purpose module.

Alternatively, if you intend to use the Matisse templating engine plugin for developing a website or a web application, you may use this command instead:

```bash
workman make:matisse-module
```

Workman will install the required packages and generate a ready to use scaffold with base templates, routing, navigation and module configuration.

