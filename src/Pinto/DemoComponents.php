<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Pinto\Attribute\Definition;
use Pinto\Attribute\ObjectType;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;

/**
 * These components are for demo purposes. They don't need to be in the same codebase as the theme.
 */
#[CanonicalProduct]
#[ObjectType\Slots(bindPromotedProperties: true)]
enum DemoComponents implements ObjectListInterface {

  use DemoListTrait;

  #[Definition(Header::class)]
  case Header;

  #[Definition(Footer::class)]
  case Footer;

  #[Definition(Branding::class)]
  case Branding;

  #[Definition(Menu::class)]
  case Menu;

  #[Definition(Breadcrumb::class)]
  case Breadcrumb;

}
