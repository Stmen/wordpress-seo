<?php

namespace Yoast\WP\SEO\Tests\Presentations\Indexable_Static_Home_Page_Presentation;

use Mockery;
use Yoast\WP\SEO\Helpers\Date_Helper;
use Yoast\WP\SEO\Helpers\Post_Type_Helper;
use Yoast\WP\SEO\Helpers\Pagination_Helper;
use Yoast\WP\SEO\Presentations\Indexable_Static_Home_Page_Presentation;
use Yoast\WP\SEO\Tests\Mocks\Indexable;
use Yoast\WP\SEO\Tests\Mocks\Meta_Tags_Context;
use Yoast\WP\SEO\Tests\Presentations\Presentation_Instance_Dependencies;

/**
 * Trait Presentation_Instance_Builder
 */
trait Presentation_Instance_Builder {
	use Presentation_Instance_Dependencies;

	/**
	 * @var Indexable
	 */
	protected $indexable;

	/**
	 * @var Indexable_Static_Home_Page_Presentation|Mockery\MockInterface
	 */
	protected $instance;

	/**
	 * @var Post_Type_Helper|Mockery\MockInterface
	 */
	protected $post_type_helper;

	/**
	 * @var Meta_Tags_Context|Mockery\MockInterface
	 */
	protected $context;

	/**
	 * @var Date_Helper
	 */
	protected $date_helper;

	/**
	 * Holds the Pagination_Helper instance.
	 *
	 * @var Pagination_Helper|Mockery\MockInterface
	 */
	protected $pagination;

	/**
	 * Builds an instance of Indexable_Static_Home_Page_Presentation.
	 */
	protected function set_instance() {
		$this->indexable = new Indexable();

		$this->post_type_helper = Mockery::mock( Post_Type_Helper::class );
		$this->context          = Mockery::mock( Meta_Tags_Context::class )->makePartial();
		$this->date_helper      = Mockery::mock( Date_Helper::class );
		$this->pagination       = Mockery::mock( Pagination_Helper::class );

		$instance = Mockery::mock(
			Indexable_Static_Home_Page_Presentation::class,
			[
				$this->post_type_helper,
				$this->date_helper,
				$this->pagination,
			]
		)
			->shouldAllowMockingProtectedMethods()
			->makePartial();

		$this->instance = $instance->of(
			[
				'model'   => $this->indexable,
				'context' => $this->context,
			]
		);

		$this->set_instance_dependencies( $this->instance );

		$this->context->indexable = $this->indexable;
	}
}