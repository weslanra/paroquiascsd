<?php
/**
 *  Registre todas as ações e filtros para o plugin
 *
 * @link       http://www.avonale.com/
 * @since      1.0.0
 *
 * @package    AvonalePlugin
 * @subpackage AvonalePlugin/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress Avonale. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    AvonalePlugin
 * @subpackage AvonalePlugin/includes
 * @author     Avonale <weslan.alves@napista.com.br>
 */

class Avonale_Loader {

	/**
   *  O conjunto de ações registradas no WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
   *  O conjunto de filtros registrados no WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
   *  Inicialize as coleções usadas para manter as ações e filtros.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->actions = array();
		$this->filters = array();
	}

	/**
   *  Adicione uma nova ação à coleção a ser registrada no WordPress.
	 *
	 * @since    1.0.0
	 * @param      string               $hook             The name of the WordPress action that is being registered.
	 * @param      object               $component        A reference to the instance of the object on which the action is defined.
	 * @param      string               $callback         The name of the function definition on the $component.
	 * @param      int      Optional    $priority         The priority at which the function should be fired.
	 * @param      int      Optional    $accepted_args    The number of arguments that should be passed to the $callback.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
   *  Adicione um novo filtro à coleção para ser registrado no WordPress.
	 *
	 * @since    1.0.0
	 * @param      string               $hook             The name of the WordPress filter that is being registered.
	 * @param      object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param      string               $callback         The name of the function definition on the $component.
	 * @param      int      Optional    $priority         The priority at which the function should be fired.
	 * @param      int      Optional    $accepted_args    The number of arguments that should be passed to the $callback.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
   *  Uma função de utilitário que é usada para registrar as ações e ganchos em 
   *  uma única coleção.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param      string               $hook             The name of the WordPress filter that is being registered.
	 * @param      object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param      string               $callback         The name of the function definition on the $component.
	 * @param      int      Optional    $priority         The priority at which the function should be fired.
	 * @param      int      Optional    $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   type                                   The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;
	}

	/**
   *  Registre os filtros e ações com o WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		foreach ( $this->filters as $hook ) {
			add_filter(
        $hook[ 'hook' ], 
        array( 
          $hook[ 'component' ], 
          $hook[ 'callback' ] 
        ), 
        $hook[ 'priority' ], 
        $hook[ 'accepted_args' ] 
      );
		}

		foreach ( $this->actions as $hook ) {
			add_action( 
        $hook[ 'hook' ], 
        array( 
          $hook[ 'component' ], 
          $hook[ 'callback' ] 
        ), 
        $hook[ 'priority' ], 
        $hook[ 'accepted_args' ] 
      );
		}
	}
}
