<?php
	
	/* Customize Breadcrumb */
	function YOURTHEME_breadcrumb($variables) {
		
		$variables['breadcrumb'][] = str_replace('&amp;amp;', '&amp;', l(drupal_get_title(), arg(0)."/".arg(1)));
		
		$variables['breadcrumb'] = array_slice($variables['breadcrumb'], 1);
		
		$sep = ' &raquo; ';
	
		if (count($variables['breadcrumb']) > 0) {
			return implode($sep, $variables['breadcrumb']);
		} else {
			return t("Home");
		}
	}
	
	/* Change links linking to just "http://" to an A tag without a href */
	function YOURTHEME_menu_link($variables) {
		
		$element = $variables['element'];
		
		$sub_menu = '';
		
		if ($element['#below']) {
			$sub_menu = drupal_render($element['#below']);
		}
		
		$output = preg_replace('/href="http:\/\/"/', '', l($element['#title'], $element['#href'], $element['#localized_options']));
		
		return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
		
	}
	
	/* Customize title tags */
	function YOURTHEME_preprocess_html(&$vars) {
	
		if(drupal_get_title()=="Home") {
			$vars['head_title'] = variable_get('site_name');
		} else {
			$vars['head_title'] = drupal_get_title() . " | " .variable_get('site_name');
		}
		
	}
	
	/* Allow page--content-type.tpl.php theme files to be used */
	function YOURTHEME_preprocess_page(&$vars) {
		if (isset($vars['node']->type)) {
			$vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
		}
	}
	
	/* Don't use this */
	function render_image_field($node, $fieldName, $format, $index=0) {
		if(field_get_items('node', $node, $fieldName)) {
			return render_field($node, $fieldName, $index, array( 'type' => 'image', 'settings' => array('image_style' => $format , /*'image_link' => 'content',*/)));
		} else {
			return null;
		}
	}
	/* Don't use this */
	function render_field($node, $fieldName, $index=0, $options=array()) {
		$field = field_get_items('node', $node, $fieldName);
		return render( field_view_value('node', $node, $fieldName, $field[$index], $options));
	}
	
	/* remove default JQuery UI css */
	function YOURTHEME_css_alter(&$css) {
		$disabled_drupal_css = array(
			'misc/ui/jquery.ui.core.css',
			'misc/ui/jquery.ui.theme.css'
		);
		
		// Remove drupal default css files.
		foreach ($css as $key => $item) {
			if (in_array($key, $disabled_drupal_css)) {
				// Remove css and its altered version that can be added by jquety_update.
				unset($css[$css[$key]['data']]);
				unset($css[$key]);
			}
		}
	}
	
	/* IE7 css */
	drupal_add_css(path_to_theme() . '/css/ie7-fixes.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
	
	/* HTML5 SHIV */
	$html5shiv = array(
		'#tag' => 'script',
		'#attributes' => array(
			'src' => '/'.drupal_get_path('theme', 'CIS2014') . '/libs/html5shiv.min.js', 
		),
		'#prefix' => '<!--[if lte IE 8]>',
		'#suffix' => '</script><![endif]-->',
	);
	drupal_add_html_head($html5shiv, 'html5shiv');

?>