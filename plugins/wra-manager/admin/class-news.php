<?php
/**
 * Funcionalidades referentes ao CPT notícias.
 *
 * @link       https://github.com/weslanra/paroquiascsd
 * @since      1.0.0
 *
 * @package    AvonalePlugin
 * @subpackage AvonalePlugin/includes
 */

/**
 * 	Funcionalidades referentes ao CPT notícias.
 *
 * @package    wra_manager
 * @subpackage wra_manager/admin
 * @author     Weslan <weslan.rezende@gmail.com>
 */
class News {

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
      'name' 					=> 'Notícias',
      'menu_name' 		=> 'Notícias',
      'singular_name' => __( 'Notícia', 'noticia' ),
      'add_new_item'  => 'Adicionar Novo Item',
    );
    $args = array(
      'label'                 => 'Notícias',
      'description'           => 'Lista de notícias',
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'post',
    );

    register_post_type( 'noticias', $args );
  }

  /**
   * Criando grupo de campos
   *
   * @return void
   */
  function register_field_groups() {
		if( function_exists( 'acf_add_local_field_group' ) ) {
      // Campos do CPT notícias
      acf_add_local_field_group( array(
        'key'     	=> 'news_fields',
        'title' 		=> 'Mias Informações',
        'fields' 		=> array(
          array( 
            'key'               => 'alert',
            'name'              => 'alert',
            'label'             => 'Aviso importante?',
            'type'              => 'true_false',
            'instructions'      => 'Informe se a notícia é um aviso importante ou não',
            'required'          => 0,
          ),
          array( 
            'key'               => 'community',
            'name'              => 'community',
            'label'             => 'Comunidade',
            'type'              => 'select',
            'instructions'      => 'Selecione a comunidade, a qual essa notícia pertence',
            'required'          => 1,
            'choices'           => array( 
              'Matriz'                      => 'Matriz',
              'Bom Pastor'                  => 'Bom Pastor',
              'Santa Cecília'               => 'Santa Cecília',
              'São José'                    => 'São José',
              'Nossa Senhora da Conceição'  => 'Nossa Senhora da Conceição',
            ),
            'return_format'     => 'value',
          ),
          array(
						'key' 					=> 'gallery',
						'label' 				=> 'Galeria',
						'name' 					=> 'gallery',
						'type' 					=> 'gallery',
						'return_format' => 'array',
						'preview_size' 	=> 'medium',
						'insert' 				=> 'append',
						'library' 			=> 'all',
					)
        ),
        'location' => array(
					array(
						array(
							'param' 		=> 'post_type',
							'operator' 	=> '==',
							'value' 		=> 'noticias',
						),
					),
				),
        'menu_order' 								=> 0,
        'position' 									=> 'normal',
        'style' 										=> 'default',
        'label_placement' 					=> 'top',
        'instruction_placement' 		=> 'label',
        'hide_on_screen' 						=> '',
        'active' 										=> true,
        'description' 							=> '',
      ));
    }
	}
}
