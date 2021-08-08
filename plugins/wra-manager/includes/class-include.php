<?php
/**
 *  O arquivo que define a classe core do plugin
 * 
 *  Uma definição de classe que inclui atributos e funções usadas para contruir 
 *  rotas de consumo do Plugin Avonale
 *
 * @link       http://www.avonale.com/
 * @since      1.0.0
 *
 * @package    AvonalePlugin
 * @subpackage AvonalePlugin/includes
 */

/**
 *  A classe core do plugin.
 * 
 *  Isso é usado para definir internacionalização, ganchos específicos do 
 *  administrador e ganchos de sites voltados para o público.
 * 
 *  Também mantém o identificador único deste plugin, bem como o atual
 *  versão do plugin.
 *
 * @since      1.0.0
 * @package    AvonalePlugin
 * @subpackage AvonalePlugin/includes
 * @author     Avonale <weslan.alves@napista.com.br>
 */
class Avonale_Include {

	/**
	 * 	O loader é responsável por manter e registrar todos os ganchos que acionam o plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Avonale_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * 	O identificador exclusivo deste plugin.
	 * 
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * A versão atual do plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * 	Defina a funcionalidade principal do plugin.
	 * 	
	 * 	Defina o nome do plugin e a versão do plugin que pode ser usada em todo o plugin.
	 * 	Carregue as dependências, defina a localidade e defina os ganchos para a 
	 * 	área administrativa e o lado voltado para o público do site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_name 	= 'avonale_assobens';
		$this->version 			= '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * 	Carregue as dependências necessárias para este plugin.
	 * 
	 * 	Inclua os seguintes arquivos que constituem o plug-in:
	 * 	- Avonale_Loader. Orquestra os ganchos do plug-in.
	 * 	- Avonale_i18n. Define a funcionalidade de internacionalização.
	 * 	- Avonale_Admin. Define todos os ganchos para a área administrativa.
	 *  - Avonale_Public. Define todos os ganchos para o lado público do site.
	 * 
	 * 	Crie uma instância do carregador que será usada para registrar os ganchos 
	 * 	com o WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * 	A classe responsável por orquestrar as ações e filtros do plugin principal.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';

		/**
		 * 	A classe responsável por definir a funcionalidade de internacionalização 
		 * 	do plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';

		/**
		 * 	A classe responsável por definir todas as ações que ocorrem na área administrativa.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';

		/**
		 * 	A classe responsável por definir todas as ações para o CPT de notícias.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-news.php';

		/**
		 * 	A classe responsável por definir todas as ações que ocorrem no lado 
		 * 	voltado para o público do site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-public.php';

		$this->loader = new Avonale_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Avonale_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 * 
	 * pt-br
	 * 	Defina a localidade para este plugin para internacionalização.
	 * 
	 * 	Usa a classe Avonale_i18n para definir o domínio e registrar o gancho com 
	 * 	WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Avonale_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * 	Registre todos os ganchos relacionados à funcionalidade da área de 
	 * 	administração do plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Avonale_Admin( $this->get_plugin_name(), $this->get_version() );
		$news 				= new News( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu_page' );

		// Notícias
		$this->loader->add_action( 'init', $news, 'register_post_type' );
		$this->loader->add_action( 'acf/init', $news, 'register_field_groups' );
	}

	/**
	 * 	Registre todos os ganchos relacionados à funcionalidade voltada ao 
	 * 	público do plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Avonale_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * 	Execute o carregador para executar todos os ganchos com o WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * 	O nome do plugin usado para identificá-lo exclusivamente no contexto do 
	 * 	WordPress e para definir a funcionalidade de internacionalização.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * 	A referência à classe que orquestra os ganchos com o plug-in.
	 *
	 * @since     1.0.0
	 * @return    Avonale_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * 	Recupere o número da versão do plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}