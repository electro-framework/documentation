# Installation

<!-- toc -->

### Runtime requirements

- PHP >= 5.6
- Composer
- PHP Extensions:
  - PDO
  - CURL
  - Mcrypt
  - GD2

### Development-time requirements

- Node.js + npm

### 1. Install Composer

Electro uses [Composer](http://getcomposer.org) to manage its dependencies. So, before using Electro, you will need to make sure you have Composer installed on your machine.

[Composer installation instructions](https://getcomposer.org/doc/00-intro.md#system-requirements).

### 2. Install Node.js

Node.js is required **during development**, because Electro requires some tools that are provided as Node packages.

> **Note:** when running on production, your app/website will not need Node.js.

### 3. Configure your environment

You must add some paths to your environment's PATH variable:

Path                | Why?
--------------------|--------
`bin`               | So that Electro commands can be run easily on the terminal.
`node_modules/.bin` | So that automation scripts may locate tools provide by Node packages

> **Warning:** examples on the framework's documentation and Readme files assume your PATH is configured this way. Failure to do this will cause errors when running the examples or even when installing the framework.

#### Configuring the path

**You only have to do this once**.
You can skip this step if your path is already configured this way.

> You can check your current path by typing: `echo $PATH` on MacOS/Linux or `echo %PATH%` on Windows.

##### On MacOS and Linux

Add this to your *shell environment*:

```bash
export PATH=bin:node_modules/.bin:$PATH
```

> Put this line at the end of **one** of these files: `~/.profile`, `~/.bash_profile` or `~/.bashrc`, in that preference order.<br>
> Depending on your operating system type and configuration, one or more of these files may be present on your home folder.

Restart your terminal to apply the changes.

##### On Windows

To set persistent environment variables at the command line, we will use `setx.exe`. It became part of Windows as of Vista/Windows Server 2008. Prior to that, it was part of the Windows Resource Kit.

Run this command:

```
setx PATH "bin;node_modules\.bin;%PATH%"
```

Restart your terminal to apply the changes.

### 4. Install the project

On the parent folder where the project folder will be created, issue the `composer create-project` command on your terminal.

For example, this will install a working Electro prototype project into the `your-project-name` folder:


```bash
cd parent-folder
composer create-project electro/electro your-project-name
```

### 5. Follow the Configuration Wizard

At the end of the installation procedure, the Configuration Wizard automatically runs to perform the final installation steps.

The Wizard scaffolds some of the application's directory structure and then proceeds to setting up the application's configuration.

Answer the Wizard's questions to customize the application to your needs.

### 6. Done :-)

Read the [next chapter](getting-started/running) to learn about the best way to launch and view the bare-bones web application that has just been installed.
