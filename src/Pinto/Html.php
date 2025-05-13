<?php

declare(strict_types=1);

namespace Drupal\pinto_theme_example\Pinto;

use Drupal\Component\Utility\Crypt;
use Drupal\Core\Cache\RefinableCacheableDependencyInterface;
use Drupal\Core\Render\AttachmentsInterface;
use Drupal\Core\Render\AttachmentsTrait;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Template\Attribute;
use Drupal\pinto_theme\PintoTheme\Html\PintoThemeHtmlContext;
use Drupal\pinto_theme\PintoTheme\Html\PintoThemeHtmlObjectInterface;
use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Utility\ObjectTrait;

#[Css('html.css')]
final class Html implements PintoThemeHtmlObjectInterface, AttachmentsInterface, RefinableCacheableDependencyInterface {

  use ObjectTrait;
  // @todo move up to ObjectTrait.
  use AttachmentsTrait;

  public function __construct(
    public Page $page,
    public ?array $top = null,
    public ?array $bottom = null,
    public string $placeholderToken = '',
    public string $htmlTitle = '',
    public Attribute $htmlAttributes = new Attribute(),
  )
  {
  }

  public static function createHtmlObjectFrom(PintoThemeHtmlContext $context): object {
    return new static(
      new Page($context->getTitle(), $context->getContent()),
      top: $context->hasTop() ? $context->getTop() : NULL,
      bottom: $context->hasBottom() ? $context->getBottom() : NULL,
    );
  }

  protected function build(Slots\Build $build): Slots\Build {
    // @todo a bunch of this could be abstracted out into something reusable.
    // Glue similar to \template_preprocess_html().
    $language = \Drupal::languageManager()->getCurrentLanguage();
    $htmlAttributes = new Attribute();
    $htmlAttributes['lang'] = $language->getId();
    $htmlAttributes['dir'] = $language->getDirection();

    // Create placeholder strings:
    $placeHolderToken = Crypt::randomBytesBase64(55);
    $this->addAttachments(['html_response_attachment_placeholders' => \array_map(static function (string $placeholderName) use ($placeHolderToken): string {
      // Items are processed in \Drupal\Core\Render\HtmlResponseAttachmentsProcessor::processAttachments
      return \sprintf('<%s-placeholder token="%s">', $placeholderName, $placeHolderToken);
    }, [
      // Keys are per \Drupal\Core\Render\HtmlResponseAttachmentsProcessor::process*(), values are per template, but get their `-placeholder` suffix in the callback.
      'styles' => 'css',
      'scripts' => 'js',
      'scripts_bottom' => 'js-bottom',
      'head' => 'head',
    ])]);

    return $build
      ->set('htmlAttributes', $htmlAttributes)
      // \template_preprocess_html() also renders 🤮.
      ->set('htmlTitle', \Drupal::service(RendererInterface::class)->render($this->page->title))
      ->set('top', $this->top)
      ->set('bottom', $this->bottom)
      ->set('placeholderToken', $placeHolderToken)
    ;
  }

}
