<?php

namespace Drupal\gluu_sso\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'DefaultBlock' block.
 *
 * @Block(
 *  id = "default_block",
 *  admin_label = @Translation("DefaultBlock"),
 * )
 */
class DefaultBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
         'test' => 1,
         'test' => 2,
        ] + parent::defaultConfiguration();

 }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['test'] = [
      '#type' => 'text_format',
      '#title' => $this->t('test'),
      '#description' => $this->t('tets'),
      '#default_value' => $this->configuration['test'],
      '#weight' => '0',
    ];
    $form['test'] = [
      '#type' => 'textfield',
      '#title' => $this->t('tetst'),
      '#description' => $this->t('tt'),
      '#default_value' => $this->configuration['test'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['test'] = $form_state->getValue('test');
    $this->configuration['test'] = $form_state->getValue('test');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['default_block_test']['#markup'] = '<p>' . $this->configuration['test'] . '</p>';
    $build['default_block_test']['#markup'] = '<p>' . $this->configuration['test'] . '</p>';

    return $build;
  }

}
