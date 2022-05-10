<?php
/**
 * Funcionalidades referentes ao CPT espaço do frei.
 *
 * @link       https://github.com/weslanra/paroquiascsd
 * @since      1.0.0
 *
 * @package    RnDPlugin
 * @subpackage RnDPlugin/includes
 */

/**
 * 	Funcionalidades referentes ao CPT notícias.
 *
 * @package    wra_manager
 * @subpackage wra_manager/admin
 * @author     Weslan <weslan.rezende@gmail.com>
 */
class Friar_Space {

	/**
	 * 	O ID deste plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * 	A versão deste plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * 	Inicialize a classe e defina suas propriedades.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name 	= $plugin_name;
		$this->version 			= $version;
	}

	/**
	 * 	Registre as folhas de estilo para a área administrativa.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		
	}

	/**
	 * 	Registre o JavaScript para a área administrativa.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

	}

  /**
   * Registro Custom Post Type Notícias
   *
   * @return void
   */
  public function register_post_type() {
    $labels = array (
      'name' 					=> 'Espaço do frei',
      'menu_name' 		=> 'Espaço do frei',
      'singular_name' => __( 'Espaço do frei', 'Espaço do frei' ),
      'add_new_item'  => 'Adicionar Novo Item',
    );
    $args = array(
      'label'                 => 'Espaço do frei',
      'description'           => 'Lista de posts do frei',
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail' ),
			'capability_type'     	=> array( 'friar_spaces', 'friar_space' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true
    );

    register_post_type( 'espaco-frei', $args );
  }
}
