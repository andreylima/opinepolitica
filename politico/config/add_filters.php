<?php



function auto_insert_excerpt(){
	$post_data = &$_POST;
	$post_content = $post_data['content'];
	$length = 25;

	// This will return the first $length number of CHARACTERS
	//$output = (strlen($post_content) > 13) ? substr($post_content,0,$length).'...' : $post_content;

	// This will return the first $length number of WORDS
	$post_content_array = explode(' ',$post_content);
	if(count($post_content_array) > $length && $length > 0)
		$output = implode(' ',array_slice($post_content_array, 0, $length)).'...';

	return $output;
}
add_filter('excerpt_save_pre', 'auto_insert_excerpt');




function wpmayor_filter_image_sizes( $sizes) {

unset( $sizes['medium']);
unset( $sizes['large']);


return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'wpmayor_filter_image_sizes');

add_image_size( 'custom', 300, 300, true );




add_filter('comment_form_default_fields', 'url_filtered');
function url_filtered($fields)
{
  if(isset($fields['url']))
   unset($fields['url']);
  return $fields;
}


add_filter( 'comment_form_defaults', 'cd_pre_comment_text' );


function cd_pre_comment_text( $arg ) {
  $arg['comment_notes_before'] = "Want to see your ugly mug by your comment? Get a free custom avatar at <a href='http://www.gravatar.com' target='_blank' >Gravatar</a>.";
  return $arg;
}



class Comment_Says_Custom_Text_Wrangler {
	function comment_says_text($translation, $text, $domain) {
	
	$ID = get_the_ID();

	$comment_id = get_comment_ID();
	$author = get_comment( $comment_id );

	$quem_positivou = get_post_meta( $post_id, 'positivar_projeto', true);
	$quem_negativou = get_post_meta( $post_id, 'negativar_projeto', true);

	if (!empty($quem_positivou)) {
		
		if (in_array($author , $quem_positivou )) {
			$voto = "Apoia";
		}
		elseif (in_array($author , $quem_negativou)) {
			$voto = "Não Apoia";
		}
		else
		{
			$voto = "Não Votou";
		}
	}
	else
	{
		if (!empty($quem_negativou)) 
		{
			if (in_array($author , $quem_negativou )) 
			{
				$voto = "Não Apoia";
			}
			else
			{
			$voto = "Não Votou";
			}
		}
		else
		{
			$voto = "Não Votou";
		}

	}


	$new_says = ' - <span class="voto-comment">' . $voto . '</span> ' ;//whatever you want to have instead of 'says' in comments
    $translations = &get_translations_for_domain( $domain );
    if ( $text == '<cite class="fn">%s</cite> <span class="says">says:</span>' ) {
	   if($new_says) $new_says = ' '.$new_says; //compensate for the space character
       return $translations->translate( '<cite class="fn">%s</cite><span class="says">'.$new_says.' - </span>' );
     } else {
    return $translation; // standard text
	 }  
	}
}
add_filter('gettext', array('Comment_Says_Custom_Text_Wrangler', 'comment_says_text'), 10, 4);











?>