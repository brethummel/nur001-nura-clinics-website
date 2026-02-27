<?php	

// ======================================= //
//         CUSTOM BIO BLOCK FIELDS         //
// ======================================= //

function spr_mod_bio_title_field($value, $post_id, $field) {

	if(have_rows('content_blocks', $post_id)): 
		while(have_rows('content_blocks', $post_id)): the_row();
			if (get_row_layout() == 'block_bio'):
				$certifications = get_sub_field('bio_info')['info']['certifications'];
				$certifications = str_replace('<p>', '<p class="certifications">', $certifications);
				$certifications = str_replace('</p>', '', $certifications);
			endif;
		endwhile;
	endif;

	return $value . '</p>' . $certifications;
}
add_filter('acf/format_value/key=field_662047d80aa9e', 'spr_mod_bio_title_field', 10, 3);


// ======================================= //
//       SET POST LINKS TARGET BLANK       //
// ======================================= //

function spr_filter_post_link($post_link, $post) {
	if ($post->post_type == 'post') {
		$settings = get_field('post_settings', $post->ID);
		// echo('<pre>'); print_r($field); echo('</pre>');

		if ($settings['type'] == 'pdf') {
			$post_link = $settings['pdf']['url'] . '" target="_blank';
		} elseif ($settings['type'] == 'url') {
			$post_link = $settings['url'] . '" target="_blank';
		}

	}
	return $post_link;
}
add_filter('post_type_link', 'spr_filter_post_link', 10, 2);

?>