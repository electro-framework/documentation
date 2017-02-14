<?php
  const APP_NAME = 'electro';
  const THEME = 'theme1'; // Either 'theme1' or 'theme2'

  require 'lib/Parsedown.php';
  require 'lib/ParsedownExtra.php';

  /*
   * Selected options for the Prism plugin:
   * - Themes: Default
   * - Languages: Markup, CSS, Javascript, Bash, JSON, Less, PHP, SQL
   * - Plugins: Line Numbers
   * Note: the Show Language plugin is not used, but an alternative implementation is provided below.
   */
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>My Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php
    $path = dirname ($_SERVER['SCRIPT_NAME']);
    echo $path == '/' ? '' : $path;
    ?>/">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic'
          rel='stylesheet'
          type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Source+Code+Pro|Exo+2:300,500,700&amp;subset=latin,cyrillic" rel="stylesheet">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">
    <link href="assets/css/prism.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>

    <?php $path =
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
    $split   = explode ('/', $path);
    $menuDir = $split[1];
    ?>
  <body class="<?= $menuDir ?>-page <?=THEME?>" onscroll="document.getElementById('mainMenu').setAttribute('data-scroll', window.scrollY ? '1' : '0')">

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
            <a class="navbar-brand" href="." contenteditable><i class="fa fa-bolt"></i><span><?=APP_NAME?></span></a>
          </div>

          <div class="collapse navbar-collapse col-md-9 navbar-links" id="navbar-collapsing">
            <ul class="nav navbar-nav">
              <li<?= $menuDir == 'index' ? ' class="active"' : '' ?>>
                <a href=".">Home</a>
              </li>
              <li<?= $menuDir == 'about' ? ' class="active"' : '' ?>>
                <a href="about">Features</a>
              </li>
              <li<?= $menuDir == 'docs' ? ' class="active"' : '' ?>>
                <a href="docs/installation">Documentation</a>
              </li>
              <li<?= $menuDir == 'download' ? ' class="active"' : '' ?>>
                <a href="download">Download</a>
              </li>
              <li<?= $menuDir == 'community' ? ' class="active"' : '' ?>>
                <a href="community">Community</a>
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

      function navMenu ($src)
      {
        return preg_replace ([
          '%<ul>%',
        ], [
          '<ul class="nav nav-list">',
        ], $src);
      }

      $NOT_FOUND = "<div class=row><div class='col-md-12'><code>$path</code> was not found.</div></div>";

      if ($menuDir == 'docs') {
        $subPath = substr ($path, 6);
        if ($subPath == '')
          $subPath = 'index';
        $file    = __DIR__ . "/src/docs/$subPath.md";
        $content = file_exists ($file) ? compileMD (file_get_contents ($file)) : $NOT_FOUND;
        ?>
        <div class="row">
          <div id="sidebar" class="col-md-3">
            <div class="sidebar-nav">
              <?= navMenu (compileMD (file_get_contents ('src/docs/menu.md', FILE_USE_INCLUDE_PATH))) ?>
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
        echo file_exists ($file) ? compileMD (file_get_contents ($file)) : $NOT_FOUND;
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
          return v == 'php' ? null : v[0].toUpperCase () + v.substr (1);
        });
    </script>
    <script src="assets/js/prism.min.js"></script>
  </body>
</html>
