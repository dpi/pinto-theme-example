<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use PreviousNext\Ds\Common\Utility\ObjectTrait;

final class Footer {

  use ObjectTrait;

  public function __construct(
    public Menu $footerMenu = new Menu(menuName: 'footer'),
    public \DateTimeInterface $date = new \DateTimeImmutable(),
  )
  {
  }

}
