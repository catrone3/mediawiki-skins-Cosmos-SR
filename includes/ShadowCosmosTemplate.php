<?php
/**
 * BaseTemplate class for ShadowCosmos skin
 * @ingroup Skins
 */
class ShadowCosmosTemplate extends CosmosTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		// Call parent execute method to render most of the skin
		parent::execute();
		
		// Add Ko-fi support link to the footer
		$this->addKofiSupport();
	}
	
	/**
	 * Add Ko-fi support link to the footer
	 */
	protected function addKofiSupport() {
		global $wgOut;
		
		$kofiHtml = '<div class="shadowcosmos-kofi-support">' .
			'<a href="https://ko-fi.com/catrone3" target="_blank">' .
			'<img src="https://storage.ko-fi.com/cdn/kofi_button_blue.png" ' .
			'alt="Support Me on Ko-fi" class="kofi-button" />' .
			'<span>Support this Wiki on Ko-fi</span>' .
			'</a></div>';
		
		// Add the Ko-fi support HTML to the footer
		$wgOut->addHTML($kofiHtml);
	}
}

