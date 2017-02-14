# Sami API Generator
Package to generate API Documentation

### What's this?

This package is a package to generate API Documentation for Impactwave Projects. This package was inpired in [Sami: an API documentation generator](https://github.com/FriendsOfPHP/Sami)

### Instalation

#### Pre-requisities

Sami API Generator system requirements:

  - PHP >= 5.4
  - Sami API Generator utilizes [Composer](http://getcomposer.org) to manage its dependencies.
  
#### Install the project and the required libraries
  
  * Clone this repository.
  * Run `composer install` command
  * You need to change config file, located in `config/config.php`
    * The `config/config.php` contains the following parameters:
    
      * `repo_url` This parameter is the type of array() and contains the git repositoys that you need to clone
      * `dir` This parameter is type of string and contains the folder where the git repositorys are cloned
      * `theme` This parameter is the type of string and contains the theme name
      * `title` This parameter is the type of string and contains the title of API Documentation
      * `build_dir` This parameter is the type of string and contains the folder where API Documentation will be generated
      * `cache_dir` This parameter is the type of string and contains the system folder where API Generator use to generate API Documentation
      * `exclude` This parameter is the type of array() and contains the folders and files that should be excluded from the generated documentation
  * After changed config file, you need to run `bin/execute` command and the Documentation of their projects will be generated!

### Documentation

For more information about this Package, please contact us by [geral@impactwave.com](mailto:geral@impactwave.com).

## License

The Sami API Generator is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).

**Sami API Generator** - Copyright &copy; Cláudio Silva, Paulo Elias and Impactwave, Lda.
