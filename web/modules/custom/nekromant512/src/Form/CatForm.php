<?php

namespace Drupal\nekromant512\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * {@inheridoc}
 */
class CatForm extends FormBase {
  /**
   * {@inheridoc}
   */
  public function buildForm (array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your cat`s name:'),
      '#descriptin' => $this->t('Name: 2-32 letters.'),
      '#required' => TRUE,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add cat'),
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
   * {@inheridoc}
   */
  public function submitForm (array &$form, FormStateInterface $form_state) {
    $title =$form_state->getValue('title');
    $this->messenger()->addMessage($this->t('You cat name: %title.', ['%title' => $title]));

  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if(strlen($form_state->getValue('title')) <2) {
      $form_state->setErrorByName(
        'title',
        $this->t('Error. Name must be at least 2 letter'));
    }
    elseif (strlen($form_state->getValue('title')) > 32) {
      $form_state->setErrorByName(
        'title',
        $this->t('Error. Name must be no more 32 letter'));
    }
  }

}


