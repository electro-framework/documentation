<?php
/*
 * Selected options for the Prism plugin:
 * - Themes: Default
 * - Languages: Markup, CSS, Javascript, Bash, JSON, Less, PHP, SQL
 * - Plugins: Line Numbers
 * Note: the Show Language plugin is not used, but an alternative implementation is provided below.
 */

require 'lib/Parsedown.php';
require 'lib/ParsedownExtra.php';

const APP_NAME = 'electro';
const THEME = 'theme1'; // Either 'theme1' or 'theme2'
const MENU_FILE = 'SUMMARY.md';
const INDEX_FILES = ['index.md', 'README.md', 'readme.md'];

$path =
  isset($_SERVER['REDIRECT_PATH'])
    ? $_SERVER['REDIRECT_PATH']
    :
    (isset($_SERVER['SCRIPT_URL'])
      ? $_SERVER['SCRIPT_URL']
      : // PHP FCGI
      (isset($_SERVER['PATH_INFO'])
        ? $_SERVER['PATH_INFO']
        : // MOD_PHP
        '/index'));
if ($path == '/')
  $path = '/index';
$split   = explode ('/', $path, 3);
$sectionDir = $split[1];

$basePath = dirname ($_SERVER['SCRIPT_NAME']);
$basePath == '/' ? '' : $basePath;

function compileMD ($src)
{
  $parser = new ParsedownExtra;
  $text = $parser->text ($src);
  $text = preg_replace_callback ('/\{\$(\w+)\}/', function ($m) {
    global $context;
    return $context[$m[1]];
  }, $text);
  return $text;
}

function preprocessSidebar ($src, $baseURL)
{
  $indices = implode ('|', array_map('preg_quote', INDEX_FILES));

  return preg_replace ([
    '%<ul>%',                         // apply CSS classes to UL elements
    '%<a href="(.+)"%',               // prepend the base URL to links
    "%<a href=\"(.*?)/($indices)\"%"  // remove names of index files (ex: 'index.md')
  ], [
    '<ul class="nav nav-list">',
    "<a href=\"$baseURL/$1\"",
    "<a href=\"$1\"",
  ], $src);
}

function preprocessContent ($src, $baseURL)
{
  $indices = implode ('|', array_map('preg_quote', INDEX_FILES));

  return preg_replace ([
    '%<a href="(.+)"%',               // prepend the base URL to links
    '%<img src="(.+)"%',              // prepend the base URL to images
    "%<a href=\"(.*?)/($indices)\"%"  // remove names of index files (ex: 'index.md')
  ], [
    "<a href=\"$baseURL/$1\"",
    "<img src=\"$baseURL/$1\"",
    "<a href=\"$1\"",
  ], $src);
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Electro Framework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?=$basePath?>/">
    <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:300,400/Roboto+Mono:400">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">
    <link href="assets/css/prism.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>

    <?php
    ?>
  <body class="<?= $sectionDir ?>-page <?=THEME?>" onscroll="document.getElementById('mainMenu').setAttribute('data-scroll', window.scrollY ? '1' : '0')">

    <nav id="mainMenu" class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="row">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header col-md-3">
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#navbar-collapsing"
                    aria-expanded="false">
              <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="."><i class="fa fa-bolt"></i><span><?=APP_NAME?></span></a>
          </div>

          <div class="collapse navbar-collapse col-md-9 navbar-links" id="navbar-collapsing">
            <ul class="nav navbar-nav">
              <li<?= $sectionDir == 'index' ? ' class="active"' : '' ?>>
                <a href=".">Home</a>
              </li>
              <li<?= $sectionDir == 'about' ? ' class="active"' : '' ?>>
                <a href="about">Features</a>
              </li>
              <li<?= $sectionDir == 'getting-started' ? ' class="active"' : '' ?>>
                <a href="getting-started">Get Started</a>
              </li>
              <li<?= $sectionDir == 'docs' ? ' class="active"' : '' ?>>
                <a href="docs">Documentation</a>
              </li>
              <li<?= $sectionDir == 'community' ? ' class="active"' : '' ?>>
                <a href="community">Community</a>
              </li>
              <li<?= $sectionDir == 'marketplace' ? ' class="active"' : '' ?>>
                <a href="marketplace">Marketplace</a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </nav>

    <div class="main container">
      <?php
      $context = [
        'my' => substr ($path, 1),
      ];

      $NOT_FOUND = "<div class=row><div class='col-md-12'><code>$path</code> was not found.</div></div>";

      $menuFile = __DIR__ . "/src/{$sectionDir}/" . MENU_FILE;
      if (file_exists ($menuFile)) {
        $file = __DIR__ . "/src$path";
        if (is_dir ($file)) {
          $dirPath = $file;
          foreach (INDEX_FILES as $f) {
            $file = "$dirPath/$f";
            if (file_exists ($file))
              break;
          }
        }
        // Append .md if no file extension is present
        elseif (!preg_match('/\..+$/', $file))
          $file .= '.md';
        $content = file_exists ($file) ? preprocessContent (compileMD (file_get_contents ($file)), $sectionDir) : $NOT_FOUND;
        ?>
        <div class="row no-gutter">
          <div id="sidebar" class="col-md-3">
            <div class="sidebar-nav">
              <?= preprocessSidebar (compileMD (file_get_contents ($menuFile)), $sectionDir) ?>
            </div>
            <!--/.well -->
          </div>
          <!--/span-->
          <div id="workspace" class="col-md-9">
            <div id="page" class="container-fluid">
              <div class="content col-md-12 col-lg-12">
                <?= $content ?>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      else {
        $file = __DIR__ . "/src$path.md";
        echo file_exists ($file) ? preprocessContent (compileMD (file_get_contents ($file)), $sectionDir) : $NOT_FOUND;
      }
      ?>
<!--      <div class="footer pull-right">-->
<!--        &copy; 2016 <a href="http://impactwave.com">Impactwave Lda</a> and <a href="http://github.com/claudio-silva">Cláudio Silva</a>-->
<!--      </div>-->
    </div>
    <!-- /container -->

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <script>
      $ ('code[class*=language-]').parent ()
        .addClass ('line-numbers')
        // Create label for all languages except PHP
        .attr ('lang', function () {
          var v = $ (this).find ('code').attr ('class').replace (/\s*language-/g, '');
          return v == 'php' ? null : v;
        });
    </script>
    <script src="assets/js/prism.min.js"></script>
    <script>
      Prism.hooks.add ('complete', function (env) {
        if (!env.code) return;

        var lnumbers = env.element.querySelector ('.line-numbers-rows');
        if (lnumbers) {
          // Hide the line numbers when there is only one.
          if (lnumbers.children.length == 1) {
            lnumbers.remove ();
            env.element.parentElement.className = env.element.parentElement.className.replace (/line-numbers/, '');
          }
          else {
            // Move the line numbers container into the PRE element, so that scrolling doesn't affect it.
            lnumbers.remove();
            env.element.parentElement.appendChild (lnumbers);
          }
        }
      });
    </script>
  </body>
</html>
