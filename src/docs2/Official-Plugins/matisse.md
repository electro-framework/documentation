# Matisse Template Engine

<!-- toc -->

## Introduction

### What is Matisse?

Matisse is a component-based template engine for PHP web applications.

It allows you to rapidly assemble complex web applications from composable building blocks.

#### What are components?

**Components** are parameterised, composable and reusable units of rendering logic, domain logic and markup, that you can assemble and configure to create visual interfaces and provide functionality to applications.

#### How does Matisse differ from other templating engines?

Like any other template engine, Matisse generates an HTML document by combining a source \(template\) document with data from your view model.

But unlike most other PHP template engines, which just render templates made of text/markup intermixed with code written in PHP or in a custom DSL, Matisse **assembles user interfaces from building blocks** called components. It also tries to **keep logic out of templates** as much as possible, therefore allowing a **clear separation of programming and presentation logic**.

Matisse templates are very **clean and readable**, and are composed only of clean HTML enhanced with additional **component tags** and **binding expressions**.

Finally, applications made with Matisse are not MVC \(Model View Controller\) based. Matisse promotes a **MVVM** \(Model, View, View Model\) architecture, with **mono** or **bi-directional data binding**.

#### How is it similar to other competing solutions?

Some concepts may remind of you of AngularJS, React or Web Components, which are client-side frameworks.

Matisse, combined with the Electro framework, brings to the server-side many of those concepts, but in simpler and easier way, allowing you to write sophisticated web applications without having to deal with Javascript, ES6, Typescript, AJAX, REST APIs, module loaders, transpilers, file watchers and complicated build toolchains. **Just write your code, switch to the browser, hit Refresh and instantly see the changes you've made come to life. Then deploy seamlessly to production.**

### What is the value proposition of Matisse?

**Matisse allows you to rapidly create complex web applications from composable building blocks.**

It reduces significantly the need to write PHP code by using components that, not only can render visual interfaces, but can also provide built-in functionality for handling data, domain logic and user interaction.

In fact, with Matisse, your entire application can be made of components, at many abstraction levels, starting from low-level design elements and widgets and progressively nesting more and more higher level abstracted concepts and constructs, up to the point where you'll be able to write your application's user interfaces with your own custom, HTML-compatible, **DSL** \(Domain Specific Language\).

With practice, your templates will become very** terse, readable, semantic **and** expressive**, but will remain **flexible** enough to accomodate any kind of custom HTML for handling specific requirements.

Your productivity will skyrocket by **reducing code to a minimum** and **reusing and sharing blocks of functionality**, both within projects and between projects.

Matisse optimizes the **workflow between designers and programmers**, by allowing designers to easily create their own components, without code, and assemble them into functional application mockups that can be converted to working prototypes by programmers with a minimum of rewriting, AND which can later return to designers for further development, remaining fully understandable to them.

Matisse also **automates** many of the tedious tasks web developers need to perform, by reducing the need to write boilerplate code, automatically managing assets \(scripts and stylesheets\), dependencies, libraries installation and integration, building and optimizing stuff for production, etc.

More than a templating engine, Matisse is an **architectural framework** for your applications, and a different way of developing them.

### See also

Take a look at the [Matisse Components](https://github.com/electro-modules/matisse-components) plugin, if you want an extensive collection of Bootstrap-based components that you can use right away on your applications.

