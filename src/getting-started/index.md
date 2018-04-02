# Installation

<!-- toc -->

## Runtime requirements

* PHP &gt;= 5.6
* Composer
* PHP Extensions:
  * PDO
  * CURL
  * Mcrypt
  * GD2

## Installation Steps

### Install Composer

Electro uses [Composer](http://getcomposer.org) to manage its dependencies. So, before using Electro, you will need to make sure you have Composer installed on your machine.

### Configure your environment

You should add `./bin` to your environment's PATH variable, so that Electro commands can be run easily on the terminal.

> Examples on the framework's documentation and Readme files assume your PATH is configured this way. Failure to do this will cause errors when running the examples.

##### Configuring the path

Add this to your _shell environment_:

```
export PATH=./bin:$PATH
```

> Put this line at the end of one of these files: `~/.bash_profile`, `~/.bashrc` or `~/.profile`, depending on you operating system type and configuration.

**You only have to do this once**. Also, first make sure your path isn't already configured this way.

> Note: you can check your current path by typing: `echo $PATH`

### Install the project

#### The recommended way \(using Electro Installer\)

We recommend that you use the `electro` command to create new projects based on the Electro framework.

First make sure the Electro Installer is installed on your machine. Type this on the terminal:

```bash
composer global require electro/installer
```

Then, on the parent folder where the project folder will be created, run the following command:

```bash
cd parent-folder
electro create your-project-name
```

This will create a project scaffold with the **latest stable** framework version.

> The installer has additional options that allow you to install a specific framework version, unstable versions and more. You may run `electro` without arguments to get an explanation of all available options.

#### Via Composer

On the parent folder where the project folder will be created, issue the `composer create-project` command on your terminal.

For example, this will install a working Electro prototype project into the `your-project-name` folder:

```bash
cd parent-folder
composer create-project electro/electro your-project-name
```

### Follow the Configuration Wizard

At the end of the installation procedure, the Configuration Wizard automatically runs to perform the final installation steps.

The Wizard scaffolds some of the application's directory structure and then proceeds to setting up the application's configuration.

Answer the Wizard's questions to customize the application to your needs.

### Check if it's working

After installation, the project should be ready to run.

It is recommended to have a local Apache web server to run it. Alternatively, you may use the built-in development server \(see below\).

If you have Apache installed, all you have to do now is to open the localhost URL corresponding to the project's folder on your browser.

You should see a welcome page.

### Using the built-in development server

The framework comes with its own built-in web server, suitable for development only. If you do not whish to install Apache on your computer, you may use it instead.

To start the server type:

```bash
workman server:start
```

The application will be available at `http://localhost:8000`.

> Run `workman help server:start` to get an explanation of all available configuration options.

To stop the server type:

```bash
workman server:stop
```

To find out whether the server is running or not, type:

```bash
workman server:status
```





