<?php

use Symfony\Component\Finder\Finder;
use Sami\Sami;

$configs = include ('config/config.php');

if (is_array($configs['repo_url']) && count($configs['repo_url'])>0)
{

  $dir = __DIR__ . $configs['dir'];

  mkdir($dir);
  chdir($dir);

  foreach ($configs['repo_url'] as $repo_url)
  {
    `git clone $repo_url`;
    echo 'Projecto clonado com sucesso!'.PHP_EOL;
  }

  chdir('../');

  $iterator = Finder::create ()
                    ->files ()
                    ->name ('*.php');

  if (is_array ($configs['exclude'])) {
    foreach ($configs['exclude'] as $exclude) {
      $iterator->exclude ($exclude);
    }
  }

  $iterator->in ($dir);

  $options = [
    'theme'     => $configs['theme'],
    'title'     => $configs['title'],
    'build_dir' => __DIR__ . $configs['build_dir'],
    'cache_dir' => __DIR__ . $configs['cache_dir'],
  ];

  echo 'Documentação criada com sucesso!'.PHP_EOL;

  $sami = new Sami($iterator, $options);

  return $sami;
}
else
{
  echo 'Não existe repositório git para clonar!'.PHP_EOL;
}


