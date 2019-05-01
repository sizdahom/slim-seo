<?php
namespace SlimSEO\Schema;

class Breadcrumbs extends Type {
	private $source;

	public function __construct( $source ) {
		$this->source = $source;
	}

	public function get_schema() {
		if ( $this->source->is_rendered() ) {
			return null;
		}

		$this->source->parse();
		$links = $this->source->get_links();
		if ( empty( $links ) ) {
			return null;
		}

		$list = [];
		foreach ( $links as $i => $link ) {
			$list[] = [
				'@type'    => 'ListItem',
				'position' => ( $i + 1 ),
				'name'     => $link['text'],
				'item'     => $link['url'],
			];
		}

		return [
			'@type'           => 'BreadcrumbList',
			'@id'             => $this->get_id(),
			'itemListElement' => $list,
		];
	}
}
