<?php
/**
 * Class that manages loading integrations.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework;

defined( 'ABSPATH' ) || exit;

/**
 * Loader class
 */
class Loader {

	/**
	 * The registered integrations.
	 *
	 * @var array<string, mixed>
	 */
	protected array $integrations = [];

	/**
	 * The registered integrations.
	 *
	 * @var array<string, mixed>
	 */
	protected array $initializers = [];

	/**
	 * The registered routes.
	 *
	 * @var array<string, mixed>
	 */
	protected array $routes = [];

	/**
	 * Hold containers
	 *
	 * @var array<string, object>
	 */
	protected array $containers = [];

	/**
	 * Magic getter for containers.
	 *
	 * @param string $name Name of property.
	 *
	 * @return mixed|null
	 */
	public function __get( $name ) {
		if ( array_key_exists( $name, $this->containers ) ) {
			return $this->containers[ $name ];
		}

		// phpcs:disable
		trigger_error(
			sprintf( 'Undefined property: %s in %s on line %d', $name, __FILE__, __LINE__ ),
			E_USER_NOTICE
		);
		// phpcs:enable

		return null;
	}

	/**
	 * Loads all registered classes if their conditionals are met.
	 *
	 * @return void
	 */
	public function load(): void {
		$this->load_initializers();

		if ( ! \did_action( 'init' ) ) {
			\add_action( 'init', [ $this, 'load_integrations' ] );
		} else {
			$this->load_integrations();
		}

		// Load routes if defined.
		if ( ! empty( $this->routes ) ) {
			\add_action( 'rest_api_init', [ $this, 'load_routes' ] );
		}
	}

	/**
	 * Register a component (integration, initializer, or route).
	 *
	 * @param string       $register_as The category to register under (e.g., 'integrations').
	 * @param string|array $class_name  The class name or class with arguments.
	 * @param string       $alias       An alias for the component.
	 * @param array|null   $args        Arguments for the class constructor.
	 *
	 * @return void
	 */
	private function register( string $register_as, $class_name, string $alias = '', $args = null ): void {
		if ( ! empty( $args ) ) {
			$class_name = [ $class_name, $args ];
		}

		if ( '' === $alias ) {
			$alias = uniqid( $register_as . '_' );
		}

		$this->{$register_as}[ $alias ] = $class_name;
	}

	/**
	 * Register an integration.
	 *
	 * @param string     $integration Class name of the integration.
	 * @param string     $alias       Alias for the integration.
	 * @param array|null $args        Arguments for the constructor.
	 *
	 * @return void
	 */
	public function register_integration( string $integration, string $alias = '', $args = null ): void {
		$this->register( 'integrations', $integration, $alias, $args );
	}

	/**
	 * Register an initializer.
	 *
	 * @param string     $initializer Class name of the initializer.
	 * @param string     $alias       Alias for the initializer.
	 * @param array|null $args        Arguments for the constructor.
	 *
	 * @return void
	 */
	public function register_initializer( string $initializer, string $alias = '', $args = null ): void {
		$this->register( 'initializers', $initializer, $alias, $args );
	}

	/**
	 * Register a route.
	 *
	 * @param string     $router Class name of the route.
	 * @param string     $alias  Alias for the route.
	 * @param array|null $args   Arguments for the constructor.
	 *
	 * @return void
	 */
	public function register_route( string $router, string $alias = '', $args = null ): void {
		$this->register( 'routes', $router, $alias, $args );
	}

	/**
	 * Load all registered initializers.
	 *
	 * @return void
	 */
	protected function load_initializers(): void {
		foreach ( $this->initializers as $alias => $class ) {
			$this->create_container( $class, 'initialize', $alias );
		}
	}

	/**
	 * Loads all registered integrations.
	 *
	 * @return void
	 */
	public function load_integrations(): void {
		foreach ( $this->integrations as $alias => $class ) {
			$this->create_container( $class, 'hooks', $alias );
		}
	}

	/**
	 * Load all registered routes.
	 *
	 * @return void
	 */
	public function load_routes(): void {
		foreach ( $this->routes as $alias => $class ) {
			$this->create_container( $class, 'register_routes', $alias );
		}
	}

	/**
	 * Create and store a container for a class.
	 *
	 * @param string|array $data   Class data.
	 * @param string       $method Method to execute.
	 * @param string       $alias  Alias for the container.
	 *
	 * @return void
	 */
	private function create_container( $data, string $method, string $alias ): void {
		$class_name = is_string( $data ) ? $data : $data[0];
		$arguments  = is_string( $data ) ? [] : $data[1];

		if ( ! \class_exists( $class_name, true ) ) {
			return;
		}

		$container = empty( $arguments ) ? new $class_name() : new $class_name( ...$arguments );

		if ( null !== $container ) {
			$container->$method();
			$this->containers[ $alias ] = $container;
		}
	}

	/**
	 * Define a constant if not already defined.
	 *
	 * @param string $name  Constant name.
	 * @param mixed  $value Constant value.
	 *
	 * @return void
	 */
	protected function define( string $name, $value ): void {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
}
