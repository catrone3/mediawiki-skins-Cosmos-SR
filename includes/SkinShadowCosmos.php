<?php

use MediaWiki\MediaWikiServices;
use MediaWiki\Skins\SkinMustache;

/**
 * SkinMustache class for ShadowCosmos skin
 * @ingroup Skins
 */
class SkinShadowCosmos extends SkinMustache {
	/** @var string */
	public $skinname = 'shadowcosmos';
	/** @var string */
	public $stylename = 'ShadowCosmos';

	/**
	 * @inheritDoc
	 */
	public function __construct( $options = [] ) {
		$options['templateDirectory'] = __DIR__ . '/../templates';
		parent::__construct( $options );
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		$data = parent::getTemplateData();
		
		// Add custom data for our templates
		$data['msg-shadowcosmos-kofi-support'] = $this->msg( 'shadowcosmos-kofi-support' )->text();
		$data['html-kofi-button'] = $this->getKofiButton();
		
		// Add site name and tagline
		$data['site-name'] = $this->msg( 'sitetitle' )->text();
		$data['site-tagline'] = $this->msg( 'sitesubtitle' )->text();
		
		return $data;
	}
	
	/**
	 * @inheritDoc
	 */
	public function getDefaultModules() {
		$modules = parent::getDefaultModules();
		$modules['styles'][] = 'skins.shadowcosmos';
		$modules['scripts'][] = 'skins.shadowcosmos.js';
		return $modules;
	}
	
	/**
	 * Get the Ko-fi support button HTML
	 * @return string HTML
	 */
	private function getKofiButton() {
		return '<a href="https://ko-fi.com/catrone3" target="_blank" class="kofi-button">' .
			'<img src="https://storage.ko-fi.com/cdn/kofi_button_blue.png" ' .
			'alt="Support Me on Ko-fi" height="36" />' .
			'<span>Support this Wiki on Ko-fi</span>' .
			'</a>';
	}
}
