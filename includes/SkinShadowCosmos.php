<?php

use MediaWiki\MediaWikiServices;

/**
 * SkinTemplate class for ShadowCosmos skin
 * @ingroup Skins
 */
class SkinShadowCosmos extends SkinTemplate {
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
		
		// Add our styles and scripts
		$out->addModuleStyles( [
			'skins.shadowcosmos'
		] );
		$out->addModules( [
			'skins.shadowcosmos.js'
		] );
	}

	/**
	 * @return array
	 */
	public function getDefaultModules() {
		$modules = parent::getDefaultModules();
		return $modules;
	}
	
	/**
	 * Add appropriate classes to the body element.
	 * @param OutputPage $out
	 * @param array &$bodyAttrs
	 */
	public function addToBodyAttributes( $out, &$bodyAttrs ) {
		$bodyAttrs['class'] .= ' skin-shadowcosmos';
		$bodyAttrs['class'] .= ' action-' . $this->getContext()->getActionName();
	}
}

