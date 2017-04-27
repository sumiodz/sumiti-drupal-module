<?php

namespace Drupal\gluu_sso\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Composer\Autoload\ClassLoader;


/**
 * Provides a 'Loginblock' block.
 *
 * @Block(
 *  id = "loginblock",
 *  admin_label = @Translation("Loginblock"),
 * )
 */
class Loginblock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Composer\Autoload\ClassLoader definition.
   *
   * @var \Composer\Autoload\ClassLoader
   */
  protected $classLoader;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        ClassLoader $class_loader
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->classLoader = $class_loader;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('class_loader')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['loginblock']['#markup'] = '<span id="openid"></span><p> Login by OpenID Provider </p><span id="base"></span> <p>Show login form </p><span id="loginsubmit"></span>';
    $build['#attached']['library'][] = 'gluu_sso/gluu_ssojs';
    $form = \Drupal::formBuilder()->getForm('Drupal\user\Form\UserLoginForm');
    $build[]=$form;
    return $build;
  }

}
