<?php
$cdn = "/";
	$meta_title_default = wp_title('|', false,'right');;
	$meta_title = $meta_title_default;
	$meta_desc_default = get_bloginfo('description');
	$meta_desc = $meta_desc_default;
	$site_url = "http://" . $_SERVER[HTTP_HOST];
	$meta_url = "http://" . $_SERVER[HTTP_HOST] . $_SERVER['REQUEST_URI'];

	global $segments;
	$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/')); 
	$template_uri = get_template_directory_uri();

	$meta_img_default = $template_uri . '/build/img/chitone_records_share.jpg';
	$meta_img = $meta_img_default;

	if ( is_single() ) {
		$meta_img = get_the_post_thumbnail_url($post->ID, "share");
		$meta_desc = get_the_excerpt();	
	}

	
	
	?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/build/css/main.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.1/TweenMax.min.js"></script>

		<script src="<?php echo get_template_directory_uri(); ?>/build/js/main.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

		<title><?php echo $meta_title; ?></title>

		<meta name="description" content="<?php echo $meta_desc; ?>"> 
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta property="og:title" content="<?php echo $meta_title; ?>" />
		<meta property="og:description" content="<?php echo $meta_desc; ?>" />
		<meta property="og:url" content="<?php echo $meta_url; ?>"/>
		<meta property="og:image" content="<?php echo $meta_img; ?>" />

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@chi-tone">
		<meta name="twitter:creator" content="@chi-tone">
		<meta name="twitter:url" content="<?php echo $meta_url; ?>">

		<meta name="twitter:description" content="<?php echo $meta_desc; ?>">
		<meta name="twitter:image" content="<?php echo $meta_img; ?>">

	</head>
	<body>
	<nav>
		<a href="/">
			<div id="navLogo" style="background-image: url(<?php echo get_header_image(); ?>)"></div>	
		</a>
		<div id="navButtons">
			<div id="navBtnHolder">
			<?php
				$menu_items = wp_get_nav_menu_items( 'Top Menu' );
				foreach ( (array) $menu_items as $key => $menu_item ) {
				    $title = $menu_item->title;
				    $url = $menu_item->url;
				    $attr_title = $menu_item->attr_title;
				    $btn_class = "navBtn";
				    //if($attr_title == $segments[0]) $btn_class = "activeBtn";
				    echo '<a href="' . $url . '"><div class="' . $btn_class . '">' . $title . '</div></a>';
				}
			?>
			</div>
			<div id="socialBtnHolder">
			<?php
				$btn_class;
				$menu_items = wp_get_nav_menu_items( 'Social Links Menu' );
				foreach ( (array) $menu_items as $key => $menu_item ) {
				    $title = $menu_item->title;
				    $url = $menu_item->url;
				    $attr_title = $menu_item->attr_title;
				    $icon_class = get_field('icon_class', $menu_item);
				    $btn_class = "socialBtn ";

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

		
		
		<div id="navMenuBtn" class="fa fa-bars" ></div>
      	<div id="navMenuCloseBtn" class="fa fa-times" ></div>
	</nav>
	
	<div id="site">
		<div id="siteHolder">