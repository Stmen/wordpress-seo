<?php

namespace Yoast\WP\SEO\Tests\Presenters;

use Yoast\WP\SEO\Presentations\Indexable_Presentation;
use Yoast\WP\SEO\Presenters\Open_Graph\Article_Published_Time_Presenter;
use Yoast\WP\SEO\Tests\TestCase;

/**
 * Class Article_Published_Time_Presenter_Test
 *
 * @coversDefaultClass \Yoast\WP\SEO\Presenters\Open_Graph\Article_Published_Time_Presenter
 *
 * @group presenters
 * @group opengraph
 */
class Article_Published_Time_Presenter_Test extends TestCase {

	/**
	 * @var Article_Published_Time_Presenter
	 */
	protected $instance;

	/**
	 * @var Indexable_Presentation
	 */
	protected $presentation;

	/**
	 * Sets up the test class.
	 */
	public function setUp() {
		$this->instance     = new Article_Published_Time_Presenter();
		$this->presentation = new Indexable_Presentation();


		return parent::setUp();
	}

	/**
	 * Tests whether the presenter returns the correct published time tag.
	 *
	 * @covers ::present
	 */
	public function test_present() {
		$this->presentation->og_article_published_time = '2019-10-08T12:26:31+00:00';

		$expected = '<meta property="article:published_time" content="2019-10-08T12:26:31+00:00" />';
		$actual   = $this->instance->present( $this->presentation );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * Tests the presenter with an empty published time.
	 *
	 * @covers ::present
	 */
	public function test_present_empty_published_time() {
		$this->presentation->og_article_published_time = '';

		$actual   = $this->instance->present( $this->presentation );

		$this->assertEmpty( $actual );
	}
}