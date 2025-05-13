<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Drupal\Core\Block\BlockManagerInterface;
use Pinto\Slots;
use PreviousNext\Ds\Common\Utility\ObjectTrait;

final class Menu {

  private const DefaultMenu = 'main';

  use ObjectTrait;

  public function __construct(
    public mixed $navigation = [],
    private string $menuName = self::DefaultMenu,
  ) {}

  protected function build(Slots\Build $build): Slots\Build {
    /** @var \Drupal\system\Plugin\Block\SystemMenuBlock $plugin */
    $plugin = static::blockManager()->createInstance(
      // A \Drupal\system\Plugin\Block\SystemMenuBlock derived from Drupal\system\Plugin\Derivative\SystemMenuBlock.
      plugin_id: sprintf('system_menu_block:%s', $this->menuName),
      configuration: [
        'id' => NULL,
        'label' => 'Menu',
        'provider' => 'system',
        'label_display' => FALSE,
        'level' => 1,
        'depth' => 0,
        'expand_all_items' => FALSE,
        'menu_name' => $this->menuName,
      ],
    );

    return $build
      // Since we are relying on rendering from Drupal, the #theme and templates
      // of core will be present. Such as #theme=menu__ from \Drupal\Core\Menu\MenuLinkTree::build.
      // To avoid these templates, build menu from scratch.
      ->set('navigation', $plugin->build());
  }

  private static function blockManager(): BlockManagerInterface {
    return \Drupal::service(BlockManagerInterface::class);
  }

}
