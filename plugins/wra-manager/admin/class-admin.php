<?php
/**
 * 	A funcionalidade específica do administrador do plugin.
 *
 * @link       https://github.com/weslanra/paroquiascsd
 * @since      1.0.0
 *
 * @package    RnDPlugin
 * @subpackage RnDPlugin/includes
 */

/**
 * 	A funcionalidade específica do administrador do plugin.
 * 
 * 	Define o nome do plug-in, a versão e dois exemplos de ganchos sobre como 
 * 	enfileirar a folha de estilo específica do administrador e o JavaScript.
 *
 * @package    wra_manager
 * @subpackage wra_manager/admin
 * @author     Weslan <weslan.rezende@gmail.com>
 */
class RnD_Admin {

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
		wp_enqueue_style( $this->plugin_name . '_admin_style', plugin_dir_url( __FILE__ ) . 'css/RnD-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * 	Registre o JavaScript para a área administrativa.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name . '_admin_script', plugin_dir_url( __FILE__ ) . 'js/RnD-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Registrando um admin menu emplacamento, exibido no painel WP,
	 *
	 * @return void
	 */
	function add_menu_page() {
		// Menu Notícias
		add_menu_page(
			'Notícias', // page title
			'Notícias', // menu title
			'publish_posts', // capability
			'news-section', // menu slug
			'', // call function
			'dashicons-admin-post', // icon url
			3 // position
		);

		// Menu Páginas
		add_menu_page(
			'Comunidades', // page title
			'Comunidades', // menu title
			'publish_community', // capability
			'community-section', // menu slug
			'', // call function
			'dashicons-text-page', // icon url
			2 // position
		);

		// Adicionando submenu ao menu matriz
		add_submenu_page( 
			'community-section', 
			'Matriz', 
			'Matriz', 
			'publish_posts', 
			'post.php?post=' . get_page_by_path( 'sobre-matriz' )->ID . '&action=edit',
			'',
			0
		);

		// Adicionando submenu ao menu bom pastor
		add_submenu_page( 
			'community-section', 
			'Bom Pastor', 
			'Bom Pastor', 
			'publish_posts', 
			'post.php?post=' . get_page_by_path( 'sobre-bom-pastor' )->ID . '&action=edit',
			'',
			1
		);

		// Adicionando submenu ao menu santa cecília
		add_submenu_page( 
			'community-section', 
			'Santa Cecília', 
			'Santa Cecília', 
			'publish_posts', 
			'post.php?post=' . get_page_by_path( 'sobre-santa-cecilia' )->ID . '&action=edit',
			'',
			2
		);

		// Adicionando submenu ao menu São José
		add_submenu_page( 
			'community-section', 
			'São José', 
			'São José', 
			'publish_posts', 
			'post.php?post=' . get_page_by_path( 'sobre-sao-jose' )->ID . '&action=edit',
			'',
			3
		);

		// Adicionando submenu ao menu Nossa Senhora da Conceição
		add_submenu_page( 
			'community-section', 
			'Nossa Senhora da Conceição', 
			'Nossa Senhora da Conceição', 
			'publish_posts', 
			'post.php?post=' . get_page_by_path( 'sobre-senhora-conceicao' )->ID . '&action=edit',
			'',
			4
		);

		// Menu Páginas
		add_menu_page(
			'Páginas', // page title
			'Página', // menu title
			'publish_community', // capability
			'page-section', // menu slug
			'', // call function
			'dashicons-welcome-widgets-menus', // icon url
			3 // position
		);

		// Adicionando submenu ao menu Nossa Senhora da Conceição
		add_submenu_page( 
			'page-section', 
			'Dízimo', 
			'Dízimo', 
			'publish_posts', 
			'post.php?post=' . get_page_by_path( 'dizimo' )->ID . '&action=edit',
			'',
			1
		);
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
							'param' 		=> 'page',
							'operator' 	=> '==',
							'value' 		=> get_page_by_path( 'dizimo' )->ID,
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
