Demonstrates how a Pinto Theme is put together.

This module could be converted to a theme if Drupal eventually makes themes have equivalent autoloading/discovery as a module. But until then...

The code here relies on a core patch @ https://www.drupal.org/project/drupal/issues/3522410 which allows us to use [objects as default values to parameters](https://wiki.php.net/rfc/new_in_initializers).
