<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Pinto\Attribute\Asset\Css;
use PreviousNext\Ds\Common\Utility\ObjectTrait;

#[Css('page.css')]
final class Page {

  use ObjectTrait;

  public function __construct(
    public array $title,
    public array $content,
    public Header $header = new Header(),
    public Footer $footer = new Footer(),
  )
  {
  }

}
