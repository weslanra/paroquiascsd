<?php
/**
 * 	A funcionalidade específica do administrador do plugin.
 *
 * @link       http://www.avonale.com/
 * @since      1.0.0
 *
 * @package    AvonalePlugin
 * @subpackage AvonalePlugin/includes
 */

/**
 * 	A funcionalidade específica do administrador do plugin.
 * 
 * 	Define o nome do plug-in, a versão e dois exemplos de ganchos sobre como 
 * 	enfileirar a folha de estilo específica do administrador e o JavaScript.
 *
 * @package    AvonalePlugin
 * @subpackage AvonalePlugin/includes
 * @author     Avonale <weslan.alves@napista.com.br>
 */
class Avonale_Admin {

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
		wp_enqueue_style( $this->plugin_name . '_admin_style', plugin_dir_url( __FILE__ ) . 'css/avonale-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * 	Registre o JavaScript para a área administrativa.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name . '_admin_script', plugin_dir_url( __FILE__ ) . 'js/avonale-admin.js', array( 'jquery' ), $this->version, false );
	}
}
