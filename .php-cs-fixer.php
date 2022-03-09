<?php 

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'vendor',
        '.git',
    ])
    ->in(__DIR__);

$config = new PhpCsFixer\Config();

$config->setRules([
        '@PSR12' => true,
        '@PHP81Migration' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'/.php-cs-fixer.cache')
    ->setFinder($finder);

return $config;
