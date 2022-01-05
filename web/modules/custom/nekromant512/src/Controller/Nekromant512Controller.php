<?php

namespace Drupal\nekromant512\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 *
 */
class Nekromant512Controller extends ControllerBase {

  /**
   *
   */
  public function build() {
    $build['content'] = [
    '#type' => 'item',
    '#markup' => $this->t('Hello! You can add here a photo of your cat.')
    ];

    return $build;
  }

}
