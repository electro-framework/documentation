<div style="text-align:center;padding:50px;margin:0;color:#FFF">

<img src="assets/electro9med.png">

<h1 style="font-size:80px;padding-top:60px;font-weight:100;margin:0;letter-spacing:9px;text-shadow:0 0 10px #fff">ELECTRO</h1>

<h3 style="margin-top:0;padding-top:15px!important;font-weight:200;letter-spacing:2px">A solid foundation for web development</h3>

</div>

---

## What is Electro?

Electro is a set of tools, libraries and conventions (a framework) that eases the creation of **well structured, well architected and maintainable** web applications, adhering to S.O.L.I.D. design principles (pun intended) and good software engeneering practices.

### Modular to the core

Electro can be extended via software add-ons called **plugins**.

The framework's core is kept small and lean, implementing only the core funcionality that is common to every web application.

A small collection of **official plugins** add additional functionality to the core, like templating engines, object/relational mappers and more.

As those plugins are completely optional, you are free to assemble your own customized framework with both your own or community-provided plugins to create the foundation that best matches the needs of your projects.

This means that you are not tied to a specific templating engine, ORM or caching solution, for example. The official plugins are just a set of possible solutions that you may or may not use, or you may even make coexist competing solutions on the same project (ex. use more that one templating engine simultaneously).

What the framework **DO** enforces though, is a set of **clearly defined interfaces** (contracts) that each plugin and application must adhere to, so that it can work seamlessly with every other plugin on the same ecosystem.

Therefore, Electro provides a true foundation for assembling software units (**modules**) that can work together as a cohesive whole.

Furthermore, those modules can work outside of Electro, either standalone or as part of other frameworks, because the way you design modules on Electro reduces framework coupling and eases code reuse on other contexts.

So, all the work you do on a Electro based project can be reused or migrated to other frameworks. If your modules depend on specific framework services, you may need to create or use a community provided adapter that translates the API to another framework's API, but it's something that is not too difficult to do.

---
