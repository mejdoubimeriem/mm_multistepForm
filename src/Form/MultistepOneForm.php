<?php

/**
 * @file
 * Contains \Drupal\mm_multistepForm\Form\MultistepOneForm.
 */

namespace Drupal\mm_multistepForm\Form;

use Drupal\Core\Form\FormStateInterface;

class MultistepOneForm extends MultistepFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'multistep_form_one';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Votre nom'),
      '#default_value' => $this->store->get('name') ? $this->store->get('name') : '',
    );

    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Votre mail'),
      '#default_value' => $this->store->get('email') ? $this->store->get('email') : '',
    );

    $form['actions']['submit']['#value'] = $this->t('Suivant');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->store->set('email', $form_state->getValue('email'));
    $this->store->set('name', $form_state->getValue('name'));
    $form_state->setRedirect('mm_multistepForm.multistep_two');
  }
}
