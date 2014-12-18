<?php

	if (!defined('__FP_UNIT')) {
		return;
	}

	$posts = Mage::getResourceModel('wordpress/post_collection')
		->load();
	
	$scodeTypes = implode('|', array(
		'contact-form-7',
	));
	
	_title('Posts with CF7 Shortcodes', 2);

	echo '<ul>';
	
	foreach($posts as $post) {
		if (preg_match('/(\[' . $scodeTypes . ')/', $post->getData('post_content'))) {
			echo sprintf('<li>Go to <a href="%s" target="_blank">%s</a> &raquo;</li>', $post->getPermalink(), cleanHtml($post->getPostTitle()));
		}
	}
	
	echo '</ul>';
