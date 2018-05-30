<nav>
	<a href="/">
		<div id="nav-logo" style="background-image: url(<?php echo get_header_image(); ?>)"></div>	
	</a>
	<div id="nav-btns">
		<div id="nav-btns-holder">
		<?php
			$menu_items = wp_get_nav_menu_items( 'Top Menu' );
			foreach ( (array) $menu_items as $key => $menu_item ) {
			    $title = $menu_item->title;
			    $url = $menu_item->url;
			    $attr_title = $menu_item->attr_title;
			    $btn_class = "nav-btn";
			    //if($attr_title == $segments[0]) $btn_class = "activeBtn";
			    echo '<a href="' . $url . '"><div class="' . $btn_class . '">' . $title . '</div></a>';
			}
		?>
		</div>
		<div id="social-btns-holder">
		<?php
			$btn_class;
			$menu_items = wp_get_nav_menu_items( 'Social Links Menu' );
			foreach ( (array) $menu_items as $key => $menu_item ) {
			    $title = $menu_item->title;
			    $url = $menu_item->url;
			    $attr_title = $menu_item->attr_title;
			    $icon_class = get_field('icon_class', $menu_item);
			    $btn_class = "social-btn ";

			   	echo '<a href="'.$url.'" target="_blank" >
                    <div class="'.$btn_class.'">
                      <span class="'.$icon_class.'" aria-hidden="true" ></span>
                      <span class="screen-reader-text">'.$title.'</span>
                    </div>
                </a>'; 
			}
		?>
		</div>
	</div>

	
	
	<div id="menu-btn" class="fa fa-bars" ></div>
  	<div id="menu-btn-close" class="fa fa-times" ></div>
</nav>