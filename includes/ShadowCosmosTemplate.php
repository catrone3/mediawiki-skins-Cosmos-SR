<?php

/**
 * BaseTemplate class for ShadowCosmos skin
 *
 * @ingroup Skins
 */
class ShadowCosmosTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' );
		?>
		<div id="sc-wrapper">
			<header id="sc-header">
				<div id="sc-header-logo-container">
					<?php if ( $this->data['logopath'] ) { ?>
						<img src="<?php echo htmlspecialchars( $this->data['logopath'] ); ?>" alt="<?php echo $this->text( 'sitename' ); ?>" id="sc-header-logo">
					<?php } ?>
					<div id="sc-header-titles">
						<h1 id="sc-site-title"><?php echo $this->text( 'sitename' ); ?></h1>
						<p id="sc-site-tagline"><?php echo $this->msg( 'tagline' )->text(); ?></p>
					</div>
				</div>
				
				<div id="sc-user-tools">
					<div id="sc-search">
						<form action="<?php $this->text( 'wgScript' ); ?>" id="sc-search-form">
							<?php echo $this->makeSearchInput( [ 'id' => 'sc-search-input' ] ); ?>
							<?php echo $this->makeSearchButton( 'go', [ 'id' => 'sc-search-button' ] ); ?>
						</form>
					</div>
					
					<div id="sc-personal-tools">
						<?php $this->renderNavigation( 'PERSONAL' ); ?>
					</div>
				</div>
			</header>
			
			<nav id="sc-nav">
				<?php $this->renderNavigation( [ 'NAMESPACES', 'VARIANTS', 'VIEWS', 'ACTIONS' ] ); ?>
			</nav>
			
			<div id="sc-content-container">
				<aside id="sc-sidebar">
					<?php $this->renderPortals( $this->data['sidebar'] ); ?>
				</aside>
				
				<main id="sc-content" class="mw-body" role="main">
					<div id="sc-content-header">
						<h1 id="firstHeading" class="firstHeading">
							<?php $this->html( 'title' ); ?>
						</h1>
						
						<div id="sc-content-actions">
							<?php $this->renderNavigation( 'ACTIONS' ); ?>
						</div>
					</div>
					
					<div id="sc-body-content" class="mw-body-content">
						<?php $this->html( 'bodytext' ); ?>
						<?php if ( $this->data['catlinks'] ) { ?>
							<?php $this->html( 'catlinks' ); ?>
						<?php } ?>
					</div>
				</main>
			</div>
			
			<footer id="sc-footer">
				<div id="sc-footer-content">
					<div id="sc-footer-links">
						<?php foreach ( $this->getFooterLinks() as $category => $links ) { ?>
							<ul id="sc-footer-<?php echo $category; ?>">
								<?php foreach ( $links as $key ) { ?>
									<li><?php $this->html( $key ); ?></li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
					
					<div id="sc-footer-icons">
						<?php foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) { ?>
							<div id="sc-footer-<?php echo htmlspecialchars( $blockName ); ?>-icons">
								<?php foreach ( $footerIcons as $icon ) { ?>
									<?php echo $this->getSkin()->makeFooterIcon( $icon ); ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
				
				<div id="sc-kofi-support">
					<a href="https://ko-fi.com/YOUR_KOFI_USERNAME" target="_blank" class="kofi-button">
						<img src="https://storage.ko-fi.com/cdn/kofi_button_blue.png" alt="Support Me on Ko-fi" height="36" />
						<span><?php echo $this->msg( 'shadowcosmos-kofi-support' )->text(); ?></span>
					</a>
				</div>
			</footer>
		</div>
		<?php
		$this->printTrail();
		echo Html::closeElement( 'body' );
		echo Html::closeElement( 'html' );
	}
	
	/**
	 * Render a series of portals
	 *
	 * @param array $portals
	 */
	protected function renderPortals( $portals ) {
		// Force the rendering of the following portals
		if ( !isset( $portals['SEARCH'] ) ) {
			$portals['SEARCH'] = true;
		}
		if ( !isset( $portals['TOOLBOX'] ) ) {
			$portals['TOOLBOX'] = true;
		}
		if ( !isset( $portals['LANGUAGES'] ) ) {
			$portals['LANGUAGES'] = true;
		}
		
		// Render portals
		foreach ( $portals as $name => $content ) {
			if ( $content === false ) {
				continue;
			}

			// Numeric strings gets an integer when set as key, cast back - T73639
			$name = (string)$name;

			switch ( $name ) {
				case 'SEARCH':
					break;
				case 'TOOLBOX':
					$this->renderPortal( 'tb', $this->getToolbox(), 'toolbox', 'sc-toolbox' );
					break;
				case 'LANGUAGES':
					if ( $this->data['language_urls'] !== false ) {
						$this->renderPortal( 'lang', $this->data['language_urls'], 'otherlanguages', 'sc-languages' );
					}
					break;
				default:
					$this->renderPortal( $name, $content );
					break;
			}
		}
	}
	
	/**
	 * Render a portal
	 *
	 * @param string $name
	 * @param array $content
	 * @param string $msg
	 * @param string|null $hook
	 */
	protected function renderPortal( $name, $content, $msg = null, $hook = null ) {
		if ( $msg === null ) {
			$msg = $name;
		}
		$msgObj = $this->getMsg( $msg );
		$labelId = Sanitizer::escapeIdForAttribute( "p-$name-label" );
		?>
		<div class="sc-portal" role="navigation" id="<?php echo Sanitizer::escapeIdForAttribute( "p-$name" ); ?>"
			<?php echo Linker::tooltip( 'p-' . $name ); ?> aria-labelledby="<?php echo $labelId; ?>">
			<h3 id="<?php echo $labelId; ?>"><?php echo htmlspecialchars( $msgObj->exists() ? $msgObj->text() : $msg ); ?></h3>
			<div class="sc-portal-content">
				<ul>
					<?php
					if ( is_array( $content ) ) {
						foreach ( $content as $key => $val ) {
							echo $this->makeListItem( $key, $val );
						}
					}
					
					if ( $hook !== null ) {
						Hooks::run( $hook, [ &$this, true ] );
					}
					?>
				</ul>
			</div>
		</div>
		<?php
	}
	
	/**
	 * Render one or more navigations elements by name, automatically reveresed
	 * when UI is in RTL mode
	 *
	 * @param array|string $elements
	 */
	protected function renderNavigation( $elements ) {
		// If only one element was given, wrap it in an array, allowing more
		// flexible arguments
		if ( !is_array( $elements ) ) {
			$elements = [ $elements ];
		}
		
		// Render elements
		foreach ( $elements as $name => $element ) {
			switch ( $element ) {
				case 'NAMESPACES':
					?>
					<div id="sc-namespaces" class="sc-nav-element">
						<ul>
							<?php
							foreach ( $this->data['namespace_urls'] as $link ) {
								?>
								<li <?php echo $link['attributes'] ?>>
									<a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>>
										<?php echo htmlspecialchars( $link['text'] ) ?>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
					break;
				case 'VARIANTS':
					?>
					<div id="sc-variants" class="sc-nav-element">
						<ul>
							<?php
							foreach ( $this->data['variant_urls'] as $link ) {
								?>
								<li <?php echo $link['attributes'] ?>>
									<a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>>
										<?php echo htmlspecialchars( $link['text'] ) ?>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
					break;
				case 'VIEWS':
					?>
					<div id="sc-views" class="sc-nav-element">
						<ul>
							<?php
							foreach ( $this->data['view_urls'] as $link ) {
								?>
								<li <?php echo $link['attributes'] ?>>
									<a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>>
										<?php echo htmlspecialchars( $link['text'] ) ?>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
					break;
				case 'ACTIONS':
					?>
					<div id="sc-actions" class="sc-nav-element">
						<ul>
							<?php
							foreach ( $this->data['action_urls'] as $link ) {
								?>
								<li <?php echo $link['attributes'] ?>>
									<a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>>
										<?php echo htmlspecialchars( $link['text'] ) ?>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
					break;
				case 'PERSONAL':
					?>
					<div id="sc-personal" class="sc-nav-element">
						<ul>
							<?php
							foreach ( $this->getPersonalTools() as $key => $item ) {
								echo $this->makeListItem( $key, $item );
							}
							?>
						</ul>
					</div>
					<?php
					break;
				default:
					// Render a custom navigation element
					// This is mainly for things like the Watch/Unwatch tab
					// which is part of the actions navigation but needs to
					// be custom rendered.
					?>
					<div id="sc-<?php echo $name; ?>" class="sc-nav-element">
						<?php echo $element; ?>
					</div>
					<?php
					break;
			}
		}
	}
}
