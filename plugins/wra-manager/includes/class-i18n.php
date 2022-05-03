<?php
/**
 *  Defina a funcionalidade de internacionalização
 * 
 *  Carrega e define os arquivos de internacionalização deste plugin 
 *  para que esteja pronto para tradução.
 *
 * @link       http://www.RnD.com/
 * @since      1.0.0
 *
 * @package    RnDPlugin
 * @subpackage RnDPlugin/includes
 */

/**
 *  Defina a funcionalidade de internacionalização.
 * 
 *  Carrega e define os arquivos de internacionalização deste plugin 
 *  para que esteja pronto para tradução.
 *
 * @package    RnDPlugin
 * @subpackage RnDPlugin/includes
 * @author     RnD <weslan.alves@napista.com.br>
 */
class RnD_i18n {
	/**
   *  O domínio especificado para este plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $domain    The domain identifier for this plugin.
	 */
	private $domain;

	/**
   *  Carregue o domínio de texto do plugin para tradução.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			$this->domain,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

	/**
   *  Defina o domínio igual ao do domínio especificado.
	 *
	 * @since    1.0.0
	 * @param    string    $domain    The domain that represents the locale of this plugin.
	 */
	public function set_domain( $domain ) {
		$this->domain = $domain;
	}
}
