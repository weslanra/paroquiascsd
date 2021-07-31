<?php
/**
 * Plugin Name:     WRA Manager
 * Plugin URI:      https://github.com/weslanra/paroquiascsd
 * Description:     Plugin com as regras de negócio da PSCSD.
 * Author:          Avonale
 * Author URI:      https://github.com/weslanra
 * Text Domain:     wra-manager
 * Domain Path:     /languages
 * Version:         1.0
 * License: GPL2
 *
 * @package         wra_manager
 */

/**
 *  Se este arquivo for chamado diretamente, aborte.
 */
if( !defined( 'WPINC' ) ) {
  die;
}

/**
 *  O código executado durante a ativação do plugin.
 *  Esta ação está documentado em includes/class-activator.php
 */
function activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	Avonale_Activator::activate();
}

/**
 * 	O código executado durante a desativação do plugin.
 * 	Esta ação está documentado em includes/class-deactivator.php
 */
function deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
	Avonale_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );

/**
 * 	A classe de plug-in principal que é usada para definir internacionalização, 
 * 	ganchos específicos do administrador e ganchos de site voltados para o público.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-include.php';

/**
 * 	Começa a execução do plugin.
 * 
 *  Uma vez que tudo dentro do plugin é registrado por meio de ganchos,
 * 	então iniciar o plugin a partir deste ponto no arquivo
 * 	não afeta o ciclo de vida da página.
 *
 * @since    1.0.0
 */
function run_wra_plugin() {
	$plugin = new Avonale_Include();
	$plugin->run();
}

run_wra_plugin();
