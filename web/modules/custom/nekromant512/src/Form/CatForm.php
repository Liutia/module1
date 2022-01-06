<?php

namespace Drupal\nekromant512\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InsertCommand;

/**
 * {@inheridoc}
 */
class CatForm extends FormBase {

  /**
   * {@inheridoc}
   */
  public function buildForm (array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your cat`s name:'),
      '#descriptin' => $this->t('Name: 2-32 letters.'),
      '#required' => TRUE,
    ];

    $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add cat'),
      '#ajax' => [
        'callback' => '::ajaxSubmit',
      ]
    ];
    return $form;
  }

  /**
   * {@inheridoc}
   */
  public function getFormId() {
    return 'Cats_form';

  }

  /**
   *
   */
  public function submitForm (array &$form, FormStateInterface $form_state) {

  }
  /**
   * {@inheridoc}
   */
  public function ajaxSubmit (array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $valideName = $this->validateName($form, $form_state);
    if ($valideName == '<2'){
      $css = ['border' => '1px solid red'];
      $message = $this->t('Name must be more 2');
    } elseif ($valideName == '>32') {
      $css = ['border' => '1px solid green'];
      $message = $this->t('Name must be not more 32');
    } else {
      $css = ['border' => '1px solid green'];
      $message = $this->t('Name is valide');
    }
    $response->addCommand(new CssCommand('#result_message', $css));
    $response->addCommand(new HtmlCommand('.result_message', $message));

  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public fuction validateName(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('name')) < 2) {
      $res = '<2';
    }
    elseif (strlen($form_state->getValue('name')) > 32) {
      $res = '>32';
    }
    else {
      $res = 'valide';
    }
    return $res;

  }

}


