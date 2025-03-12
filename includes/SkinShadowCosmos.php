<?php

namespace MediaWiki\Skins\ShadowCosmos;

use MediaWiki\MediaWikiServices;
use OutputPage;
use Skin;
use SkinTemplate;

/**
 * SkinTemplate implementation for ShadowCosmos skin
 *
 * @ingroup Skins
 */
class SkinShadowCosmos extends SkinTemplate {
	/**
	 * @inheritDoc
	 */
	public function __construct( $options = [] ) {
		$options['templateDirectory'] = __DIR__ . '/templates';
		parent::__construct( $options );
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData() {
		$data = parent::getTemplateData();
		
		// Add custom data for the template
		$data['html-kofi-button'] = $this->getKofiButton();
		
		return $data;
	}

	/**
	 * Get the Ko-fi support button HTML
	 *
	 * @return string HTML
	 */
	private function getKofiButton() {
		$kofiUsername = 'YOUR_KOFI_USERNAME'; // Replace with your actual Ko-fi username
		$kofiText = $this->msg( 'shadowcosmos-kofi-support' )->text();
		
		return '<div id="sc-kofi-support">
			<a href="https://ko-fi.com/' . htmlspecialchars( $kofiUsername ) . '" target="_blank" class="kofi-button">
				<img src="https://storage.ko-fi.com/cdn/kofi_button_blue.png" alt="Support Me on Ko-fi" height="36" />
				<span>' . htmlspecialchars( $kofiText ) . '</span>
			</a>
		</div>';
	}

	/** @var string */
	public $skinname = 'shadowcosmos';
	/** @var string */
	public $stylename = 'ShadowCosmos';
	/** @var string */
	public $template = 'ShadowCosmosTemplate';

	/**
	 * @inheritDoc
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		
		// Add viewport meta tag for mobile
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
