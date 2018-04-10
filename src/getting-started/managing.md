## Managing the installation

### Using the framework's Command Line Interface \(workman\)

Electro comes with a command line interface \(CLI\), called `workman`, that allows you to perform several tasks from the command line.

> The tasks/commands that are available depend on which plugins are installed. Your application may also provide its own commands.

On your project's root directory, type:

```bash
workman
```

You'll get a list of available commands.

Refer to the framework documentation for an explanation of each available command.

### Installing/removing packages

Electro uses several types of Composer packages:

1. Electro plugins
2. Electro templates
3. standard non-Electro packages

#### Installing packages

Type:

```bash
workman install
```

Follow the interactive instructions. You may also call the command with additional arguments for installing packages non-interactively.

> **Do not use `composer require` for installing packages.**
> 
> Instead, you should run `workman install` and select the kind of package you whish to install (a plugin, a template or a standalone, non-electro Composer package).<br>
> The last option is the equivalent of running a `composer require` command for an arbitrary package, but it registers it on a specific module of your application (chosen by you).

#### Uninstalling packages

Type:

```bash
workman uninstall
```
or
```bash
workman remove
```

Follow the interactive instructions. You may also call the command with additional arguments for uninstalling packages non-interactively.

> **Do not use `composer remove` for uninstalling packages.**
> 
> See why below.

### Handling `composer.json` and package installations via Composer

Private modules have their own `composer.json` and behave the same way as packages, but they are an integrant part of your application. As such, they are committed to your project's VCS repository directly and not installed from external sources, unlike other package types which are published on Packagist (or other private sources) and installable by Composer.

As private modules are not true Composer packages, to make their `composer.json` configurations available to Composer, the framework must manage the project's root `composer.json` file itself, so that, at any time, that file reflects the configurations inherited from all private modules.

This means the root `composer.json` is automatically generated from `workman` commands that install or remove packages. Therefore, **you should not directly modify the `composer.json` at the root directory of your project**. If you do, you will loose your changes whenever it is automatically rebuilt.

To install or remove plugins, templates and other Composer packages, you should use the relevant `workman` commands (see above).

#### How private modules are integrated with Composer

To make Composer aware of the project's private modules' configuration and dependencies, the root `composer.json`'s content is generated by merging the `composer.root.json` template file with each of the application's private modules `composer.json`.

You might be tempted to register dependencies on the `composer.root.json` file, but we also advise against that. We recommend that, instead, you always register dependencies on the modules that require them. That way, your application will be more modular and the `workman install/remove` commands will work as intedend.

#### Using Composer directly

If you whish to install/remove packages without using the respective `workman` commands, you can modify your application's private modules' `composer.json` files directly, but you still need to rebuild the project's main `composer.json` by issuing:

```bash
workman composer:update
```

This will also run `composer update` automatically, after updating the json file.