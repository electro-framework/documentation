# Setup

## Installation

#### Runtime requirements

- PHP >= 5.4 < 7.0
- Composer
- PHP Extensions:
  - PDO
  - CURL
  - Mcrypt
  - GD2

#### Install Composer

Selenia utilises [Composer](http://getcomposer.org) to manage its dependencies. So, before using Selenia, you will need to make sure you have Composer installed on your machine.

#### Configure your environment

You should add `./bin` to your environment's PATH variable, so that Selenia commands can be run easily on the terminal.
> Examples on the framework's documentation and Readme files assume your PATH is configured this way. Failure to do this will cause errors when running the examples.

##### Configuring the path

Add this to your *shell environment*:

```bash
export PATH=./bin:$PATH
```

> Put this line at the end of one of these files: `~/.bash_profile`, `~/.bashrc` or `~/.profile`, depending on you operating system type and configuration.

**You only have to do this once**. Also, first make sure your path isn't already configured this way.

> You can check your current path by typing &nbsp;`echo $PATH`

#### Install the project

On the parent folder where the project folder will be created, issue the `composer create-project` command on your terminal.

For example, this will install a working Selenia prototype project into the `your-project-name` folder:

```bash
cd parent-folder
composer create-project -s dev selenia/selenia your-project-name
```

Upon completing the installation, Composer may ask you:

    Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]?

You should type `y` to remove the Git history. You may then create your own VCS repository to hold your project.

For example, to create an empty Git repository, type:

```bash
git init
```

#### Follow the Configuration Wizard

At the end of the installation procedure, the Configuration Wizard automatically runs to perform the final installation steps.

The Wizard scaffolds some of the application's directory structure and then it proceeds to setting up the application's configuration.

Answer the Wizard's questions to customize the application to your needs.

#### Check if it's working

After installation, the project should be ready to run.

> You'll need a local Apache web server to run it.

Open the localhost URL corresponding to the project's folder on your browser.

You should see a welcome page.

#### Developing

Besides using the Composer commands to install/uninstall/update PHP packages and Selenia plugins, you can also use the Selenia CLI (Command-Line Interface).

Type:

```bash
selenia
```

You'll get a list of available commands.
Refer to the framework documentation for an explanation of each available command.