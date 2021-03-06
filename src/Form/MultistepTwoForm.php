<?php

/**
 * @file
 * Contains \Drupal\mm_multistepForm\Form\MultistepTwoForm.
 */

namespace Drupal\mm_multistepForm\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class MultistepTwoForm extends MultistepFormBase
{

  /**
   * {@inheritdoc}.
   */
  public function getFormId()
  {
    return 'multistep_form_two';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $form = parent::buildForm($form, $form_state);

    $form['age'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Votre âge'),
      '#default_value' => $this->store->get('age') ? $this->store->get('age') : '',
    );

    $form['location'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Votre adresse'),
      '#default_value' => $this->store->get('location') ? $this->store->get('location') : '',
    );

    $form['actions']['previous'] = array(
      '#type' => 'link',
      '#title' => $this->t('Précédent'),
      '#attributes' => array(
        'class' => array('button'),
      ),
      '#weight' => 0,
      '#url' => Url::fromRoute('mm_multistepForm.multistep_one'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->store->set('age', $form_state->getValue('age'));
    $this->store->set('location', $form_state->getValue('location'));

    // Save the data
    parent::saveData();
    //redirection
    $form_state->setRedirect('some_route');
  }
}
