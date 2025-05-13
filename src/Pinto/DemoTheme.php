<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Drupal\pinto_theme\PintoTheme\Attribute\Theme;
use Pinto\Attribute\Definition;
use Pinto\Attribute\ObjectType;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;

#[CanonicalProduct]
#[ObjectType\Slots(bindPromotedProperties: true)]
enum DemoTheme implements ObjectListInterface {

  use DemoListTrait;

  #[Definition(Html::class)]
  #[Theme('pinto_theme_test')]
  case Html;

  #[Definition(Page::class)]
  case Page;

}
