<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Pinto\List\ObjectListTrait;

trait DemoListTrait {

  use ObjectListTrait;

  public function name(): string
  {
    return 'DemoDs-' . $this->name;
  }

  public function templateName(): string {
    return sprintf(
      // Give templates a unique prefix name otherwise they will conflict with default `html` or `page` theme hooks.
      // @todo change defaults in Pinto Drupal module itself.
      'demo-%s',
      // Cap names to hyphen between, then remove leading hyphen.
      \strtolower(ltrim(\preg_replace_callback('/[A-Z]/', function ($matches) {
        return '-' . $matches[0];
      }, $this->name) ?? '', '-'))
    );
  }

  public function templateDirectory(): string
  {
    return '@pinto_theme_example';
  }

  public function cssDirectory(): string
  {
    // For demo purposes.
    return \Safe\realpath(__DIR__ . '/../../css');
  }

  public function jsDirectory(): string
  {
    // For demo purposes (unused).
    return '';
  }

}
