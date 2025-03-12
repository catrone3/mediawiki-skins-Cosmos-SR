<?php

use MediaWiki\Output\OutputPage;

/**
 * SkinTemplate implementation for ShadowCosmos skin
 *
 * @ingroup Skins
 */
class ShadowCosmos extends SkinTemplate {
	/** @var string */
	public $skinname = 'shadowcosmos';
	/** @var string */
	public $stylename = 'ShadowCosmos';
	/** @var string */
	public $template = 'ShadowCosmosTemplate';

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param OutputPage $out
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		
		// Add viewport meta tag for mobile
		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1.0' );
		
		// Add styles and scripts
		$out->addModuleStyles( [
			'skins.shadowcosmos.styles'
		] );
		$out->addModules( [
			'skins.shadowcosmos.js'
		] );
	}

	/**
	 * @param string $classname
	 * @return bool
	 */
	public function setupTemplate( $classname ) {
		return new ShadowCosmosTemplate();
	}
}

