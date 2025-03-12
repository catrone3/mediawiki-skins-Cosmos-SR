<?php
/**
 * BaseTemplate class for ShadowCosmos skin
 * @ingroup Skins
 */
class ShadowCosmosTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' );
		?>
		<div id="mw-wrapper" class="sc-wrapper">
			<header id="mw-header" class="sc-header">
				<?php $this->renderHeader(); ?>
			</header>
			
			<nav id="mw-navigation" class="sc-nav">
				<?php $this->renderNavigation(); ?>
			</nav>
			
			<div class="sc-content-container">
				<div id="mw-sidebar" class="sc-sidebar">
					<?php $this->renderSidebar(); ?>
				</div>
				
				<div id="mw-content" class="sc-content">
					<?php $this->renderContent(); ?>
				</div>
			</div>
			
			<footer id="mw-footer" class="sc-footer">
				<?php $this->renderFooter(); ?>
				<?php $this->renderKofiSupport(); ?>
			</footer>
		</div>
		<?php
		$this->printTrail();
		echo "</body></html>";
	}
	
	/**
	 * Render the header section
	 */
	protected function renderHeader() {
		?>
		<div class="sc-header-logo-container">
			<?php
			$logoData = $this->get( 'logopath' );
			if ( $logoData ) {
				?>
				<a href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>" class="sc-header-logo">
					<img src="<?php echo htmlspecialchars( $logoData ) ?>" alt="<?php echo $this->msg( 'sitetitle' )->escaped() ?>">
				</a>
				<?php
			}
			?>
			<div class="sc-header-titles">
				<h1 class="sc-site-title">
					<a href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>">
						<?php echo $this->msg( 'sitetitle' )->escaped() ?>
					</a>
				</h1>
				<p class="sc-site-tagline"><?php echo $this->msg( 'sitesubtitle' )->escaped() ?></p>
			</div>
		</div>
		
		<div class="sc-user-tools">
			<div class="sc-search">
				<form action="<?php $this->text( 'wgScript' ) ?>" class="sc-search-form">
					<input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
					<?php echo $this->makeSearchInput( [ 'class' => 'sc-search-input' ] ); ?>
					<?php echo $this->makeSearchButton( 'go', [ 'class' => 'sc-search-button' ] ); ?>
				</form>
			</div>
			
			<div class="sc-user-links">
				<?php $this->renderPersonalTools(); ?>
			</div>
		</div>
		
		<button class="sc-mobile-menu-toggle">
			<span></span>
			<span></span>
			<span></span>
		</button>
		<?php
	}
	
	/**
	 * Render the navigation section
	 */
	protected function renderNavigation() {
		?>
		<ul class="sc-nav-list">
			<?php
			foreach ( $this->data['content_navigation']['namespaces'] as $key => $tab ) {
				echo $this->makeListItem( $key, $tab, [
					'link-class' => 'sc-nav-link' . ( isset( $tab['class'] ) && strpos( $tab['class'], 'selected' ) !== false ? ' active' : '' )
				] );
			}
			
			foreach ( $this->data['content_navigation']['views'] as $key => $tab ) {
				echo $this->makeListItem( $key, $tab, [
					'link-class' => 'sc-nav-link' . ( isset( $tab['class'] ) && strpos( $tab['class'], 'selected' ) !== false ? ' active' : '' )
				] );
			}
			?>
		</ul>
		<?php
	}
	
	/**
	 * Render the sidebar section
	 */
	protected function renderSidebar() {
		foreach ( $this->data['sidebar'] as $name => $content ) {
			if ( !$content ) {
				continue;
			}
			
			$msgObj = wfMessage( $name );
			$labelId = Sanitizer::escapeIdForAttribute( "sc-$name" );
			?>
			<div class="sc-portlet" id="<?php echo htmlspecialchars( $labelId ) ?>">
				<h3><?php echo htmlspecialchars( $msgObj->exists() ? $msgObj->text() : $name ); ?></h3>
				<ul>
					<?php
					foreach ( $content as $key => $item ) {
						echo $this->makeListItem( $key, $item );
					}
					?>
				</ul>
			</div>
			<?php
		}
	}
	
	/**
	 * Render the content section
	 */
	protected function renderContent() {
		?>
		<div class="sc-content-header">
			<h1 class="firstHeading" id="firstHeading">
				<?php $this->html( 'title' ) ?>
			</h1>
			
			<div class="sc-content-actions">
				<?php
				foreach ( $this->data['content_navigation']['actions'] as $key => $tab ) {
					echo $this->makeListItem( $key, $tab, [
						'link-class' => 'sc-action-button'
					] );
				}
				?>
			</div>
		</div>
		
		<div id="bodyContent" class="sc-body-content">
			<?php
			if ( $this->data['subtitle'] ) {
				?>
				<div id="contentSub"><?php $this->html( 'subtitle' ) ?></div>
				<?php
			}
			
			if ( $this->data['undelete'] ) {
				?>
				<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
				<?php
			}
			
			if ( $this->data['newtalk'] ) {
				?>
				<div class="usermessage"><?php $this->html( 'newtalk' ) ?></div>
				<?php
			}
			
			// Show the article content
			$this->html( 'bodytext' );
			
			if ( $this->data['catlinks'] ) {
				$this->html( 'catlinks' );
			}
			
			if ( $this->data['dataAfterContent'] ) {
				$this->html( 'dataAfterContent' );
			}
			?>
		</div>
		<?php
	}
	
	/**
	 * Render the footer section
	 */
	protected function renderFooter() {
		?>
		<div class="sc-footer-content">
			<div class="sc-footer-links">
				<?php
				foreach ( $this->getFooterLinks() as $category => $links ) {
					foreach ( $links as $link ) {
						?>
						<a href="#" class="sc-footer-link"><?php $this->html( $link ) ?></a>
						<?php
					}
				}
				?>
			</div>
			
			<div class="sc-footer-info">
				<?php
				foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) {
					?>
					<div class="sc-footer-info-item">
						<?php
						foreach ( $footerIcons as $icon ) {
							echo $this->getSkin()->makeFooterIcon( $icon );
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
	
	/**
	 * Render the personal tools (user links)
	 */
	protected function renderPersonalTools() {
		foreach ( $this->getPersonalTools() as $key => $item ) {
			echo $this->makeListItem( $key, $item, [
				'link-class' => 'sc-user-link'
			] );
		}
	}
	
	/**
	 * Render the Ko-fi support section
	 */
	protected function renderKofiSupport() {
		?>
		<div class="sc-kofi-support">
			<a href="https://ko-fi.com/catrone3" target="_blank" class="kofi-button">
				<img src="https://storage.ko-fi.com/cdn/kofi_button_blue.png" alt="Support Me on Ko-fi" height="36" />
				<span><?php echo wfMessage( 'shadowcosmos-kofi-support' )->escaped() ?></span>
			</a>
		</div>
		<?php
	}
}

