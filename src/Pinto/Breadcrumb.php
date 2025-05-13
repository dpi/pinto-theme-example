<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Drupal\Core\Breadcrumb\BreadcrumbManager;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Routing\RouteMatchInterface;
use Pinto\Slots;
use PreviousNext\Ds\Common\Utility\ObjectTrait;

final class Breadcrumb {

  use ObjectTrait;

  public function __construct(
    public mixed $breadcrumb = [],
  ) {}

  protected function build(Slots\Build $build): Slots\Build {
    $breadcrumb = static::breadcrumb()->build(static::routeMatch())->toRenderable();
    $cache = CacheableMetadata::createFromRenderArray($breadcrumb);
    $this->addCacheableDependency($cache);
    return $build
      ->set('breadcrumb', $breadcrumb['#links'] ?? []);
  }

  private static function breadcrumb(): BreadcrumbManager {
    return \Drupal::service('breadcrumb');
  }

  private static function routeMatch(): RouteMatchInterface {
    return \Drupal::service(RouteMatchInterface::class);
  }

}
