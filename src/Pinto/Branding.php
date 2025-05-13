<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Pinto\Slots;
use PreviousNext\Ds\Common\Utility\ObjectTrait;

final class Branding {

  use ObjectTrait;

  public function __construct(
    public ?string $siteName = NULL,
  )
  {
  }

  protected function build(Slots\Build $build): Slots\Build {
    return $build
      ->set('siteName', (string) \Drupal::configFactory()->get('system.site')->get('name'));
  }

}
