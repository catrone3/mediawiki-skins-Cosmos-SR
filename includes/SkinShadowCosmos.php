<?php

use MediaWiki\MediaWikiServices;

/**
 * SkinTemplate class for ShadowCosmos skin
 * @ingroup Skins
 */
class SkinShadowCosmos extends SkinCosmos {
	/** @var string */
	public $skinname = 'shadowcosmos';
	/** @var string */
	public $stylename = 'ShadowCosmos';
	/** @var string */
	public $template = 'ShadowCosmosTemplate';

	/**
	 * @param OutputPage $out
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1.0' );
	}

	/**
	 * @return array
	 */
	public function getDefaultModules() {
		$modules = parent::getDefaultModules();
		return $modules;
	}
}

