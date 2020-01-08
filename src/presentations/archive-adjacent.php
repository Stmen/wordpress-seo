<?php
/**
 * Presentation object for indexables.
 *
 * @package Yoast\YoastSEO\Presentations
 */

namespace Yoast\WP\SEO\Presentations;

use Yoast\WP\SEO\Helpers\Pagination_Helper;

/**
 * Class Archive_Adjacent
 *
 * @property \Yoast\WP\SEO\Models\Indexable          $model      The indexable.
 * @property \Yoast\WP\SEO\Helpers\Pagination_Helper $pagination The pagination helper. Should be defined in the parent
 *                                                                class because of trait issues in PHP 5.6.
 */
trait Archive_Adjacent {

	/**
	 * Sets the helpers for the trait.
	 *
	 * @required
	 *
	 * @param Pagination_Helper $pagination The pagination helper.
	 *
	 * @codeCoverageIgnore
	 */
	public function set_archive_adjacent_helpers( Pagination_Helper $pagination ) {
		$this->pagination = $pagination;
	}

	/**
	 * @inheritDoc
	 */
	public function generate_rel_prev() {
		if ( $this->pagination->is_rel_adjacent_disabled() ) {
			return '';
		}

		$current_page = \max( 1, $this->pagination->get_current_archive_page_number() );
		// Check if there is a previous page.
		if ( $current_page === 1 ) {
			return '';
		}
		// Check if the previous page is the first page.
		if ( $current_page === 2 ) {
			return $this->model->permalink;
		}

		return $this->pagination->get_paginated_url( $this->model->permalink, ( $current_page - 1 ) );
	}

	/**
	 * @inheritDoc
	 */
	public function generate_rel_next() {
		if ( $this->pagination->is_rel_adjacent_disabled() ) {
			return '';
		}

		$current_page = \max( 1, $this->pagination->get_current_archive_page_number() );
		if ( $this->pagination->get_number_of_archive_pages() <= $current_page ) {
			return '';
		}

		return $this->pagination->get_paginated_url( $this->model->permalink, ( $current_page + 1 ) );
	}
}