</main>
	<?php if (function_exists("lc_custom_footer")) lc_custom_footer(); else {
		?>
		<?php if (is_active_sidebar( 'footerfull' )): ?>
		<div class="wrapper mt-5 py-5" id="wrapper-footer-widgets">
			
			<div class="container mb-5">
				
				<div class="row">
					<?php dynamic_sidebar( 'footerfull' ); ?>
				</div>

			</div>
		</div>
		<?php endif ?>
		
		<div class="container-fluid border-top border-5 border-primary footer-menu bg-light">
			<div class="container py-5">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<?php if (!empty(get_option('site_option_name')['footer_column_6'])): ?>
					<div class="border-start border-1 border-gray col px-4 my-2">
						<?php echo do_shortcode( get_option('site_option_name')['footer_column_6'] ); ?>
					</div>
					<?php endif ?>
					<?php
					// Me dodging learning how to do a nav walker (plus gives me lots of control?)
						$array_menu = wp_get_nav_menu_items( get_nav_menu_locations()['secondary'] );
						$menu = array();
						foreach ($array_menu as $m) {
							if (empty($m->menu_item_parent)) {
								$menu[$m->ID] = array();
								$menu[$m->ID]['ID'] = $m->ID;
								$menu[$m->ID]['title'] = $m->title;
								$menu[$m->ID]['url'] = $m->url;
								$menu[$m->ID]['children'] = array();
							}
						}
						$submenu = array();
						foreach ($array_menu as $m) {
							if ($m->menu_item_parent) {
								$submenu[$m->ID] = array();
								$submenu[$m->ID]['ID'] = $m->ID;
								$submenu[$m->ID]['title'] = $m->title;
								$submenu[$m->ID]['url'] = $m->url;
								$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
							}
						}

						foreach ( $menu as $item ) {
							?>
							<div class="border-start border-1 border-gray col ps-4 my-2">
								<span class="h4 mb-4"><?php echo $item['title']; ?></span>
							<?php
							if ( $item['children'] ){
								?><ul><?php
								foreach ( $item['children'] as $child ){
									?><li class="my-3"> <?php
										echo '<a class="text-decoration-none text-dark" href="'. $child['url'] .'">'. $child['title'] .'</a>';
									?></li><?php
								}
								?></ul></div><?php
							}
						}

					?>
				</div>
			</div>
		</div>

		<div class="d-flex justify-content-center container-fluid py-3">
			<span>© <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span>
		</div>
		
	<?php 
	} //END ELSE CASE ?>

	<?php echo do_shortcode( '[consent_popup]' ); ?>
	<?php wp_footer(); ?>

	</body>
</html>