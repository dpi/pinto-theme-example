<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use PreviousNext\Ds\Common\Utility\ObjectTrait;

final class Header {

  use ObjectTrait;

  public function __construct(
    public Branding $branding = new Branding(),
    public Menu $mainMenu = new Menu(),
    public Breadcrumb $breadcrumb = new Breadcrumb(),
  )
  {
  }

}
