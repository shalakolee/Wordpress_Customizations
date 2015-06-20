<?php 
/*
 * general functions that will be used
 */

//add theme suppoort
add_theme_support( 'woocommerce' );

//remove stupid woothemes updater
remove_action( 'admin_notices', 'woothemes_updater_notice',999 );


function stripHTML($document){ 
    $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
                   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags 
                   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
                   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
    ); 
    $text = preg_replace($search, '', $document); 
    return $text; 
} 

/*
 * usage :   sub("string", 130,"[...]")
 */
function sub($content, $count, $ellipsis="..."){
    $content = stripHTML($content);
    return strlen($content) > $count ? substr($content, 0, $count) . $ellipsis : $content;
}


function get_image_id_from_url($image_url) {
        global $wpdb;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}



/*
 * usage 
 *
 * 
 *
 * cool_title( get_the_title() ,array('#fff','#aabbcc'), 1)
 */

function cool_title($content, $colors=array(), $where=1, $element="span" ){
	
	//make sure colors are passed in, if not return the normal string
	if($colors):
		$content = explode(" ", $content); 		//break this into an array

		$retstr = "<span style='color:{$colors[0]}'>";
		for($i=0; $i < $where; $i++){
			$retstr .= $content[$i] . " ";
		}
		$retstr .= "</span>";

		if($colors[1]):
			$retstr .= "<".$element." style='color:{$colors[1]}'>";
			for($i=$where; $i<count($content); ++$i) {
				$retstr .= $content[$i] . " ";
			}
			$retstr .= "</".$element.">";
		else:
			$retstr .= implode(" ", array_slice($content, $where));
		endif;

		return $retstr;
	else:
		return $content;
	endif;
}


function get_state_dropdown($request, $name='state', $id='state', $class='' ){

	$stateselect .= "<select name='{$name}' id='{$id}' class='{$class}'>";

	$stateselect .= "<option value=''>Select a State</option>"
	. "<option value='AL' state='AL' ". ($request == 'AL' ? 'selected' : '') .">Alabama</option>"
	. "<option value='AK' state='AK' ". ($request == 'AK' ? 'selected' : '') .">Alaska</option>"
	. "<option value='AZ' state='AZ' ". ($request == 'AZ' ? 'selected' : '') .">Arizona</option>"
	. "<option value='AR' state='AR' ". ($request == 'AR' ? 'selected' : '') .">Arkansas</option>"
	. "<option value='CA' state='CA' ". ($request == 'CA' ? 'selected' : '') .">California</option>"
	. "<option value='CO' state='CO' ". ($request == 'CO' ? 'selected' : '') .">Colorado</option>"
	. "<option value='CT' state='CT' ". ($request == 'CT' ? 'selected' : '') .">Connecticut</option>"
	. "<option value='DE' state='DE' ". ($request == 'DE' ? 'selected' : '') .">Delaware</option>"
	. "<option value='DC' state='DC' ". ($request == 'DC' ? 'selected' : '') .">District Of Columbia</option>"
	. "<option value='FL' state='FL' ". ($request == 'FL' ? 'selected' : '') .">Florida</option>"
	. "<option value='GA' state='GA' ". ($request == 'GA' ? 'selected' : '') .">Georgia</option>"
	. "<option value='HI' state='HI' ". ($request == 'HI' ? 'selected' : '') .">Hawaii</option>"
	. "<option value='ID' state='ID' ". ($request == 'ID' ? 'selected' : '') .">Idaho</option>"
	. "<option value='IL' state='IL' ". ($request == 'IL' ? 'selected' : '') .">Illinois</option>"
	. "<option value='IN' state='IN' ". ($request == 'IN' ? 'selected' : '') .">Indiana</option>"
	. "<option value='IA' state='IA' ". ($request == 'IA' ? 'selected' : '') .">Iowa</option>"
	. "<option value='KS' state='KS' ". ($request == 'KS' ? 'selected' : '') .">Kansas</option>"
	. "<option value='KY' state='KY' ". ($request == 'KY' ? 'selected' : '') .">Kentucky</option>"
	. "<option value='LA' state='LA' ". ($request == 'LA' ? 'selected' : '') .">Louisiana</option>"
	. "<option value='ME' state='ME' ". ($request == 'ME' ? 'selected' : '') .">Maine</option>"
	. "<option value='MD' state='MD' ". ($request == 'MD' ? 'selected' : '') .">Maryland</option>"
	. "<option value='MA' state='MA' ". ($request == 'MA' ? 'selected' : '') .">Massachusetts</option>"
	. "<option value='MI' state='MI' ". ($request == 'MI' ? 'selected' : '') .">Michigan</option>"
	. "<option value='MN' state='MN' ". ($request == 'MN' ? 'selected' : '') .">Minnesota</option>"
	. "<option value='MS' state='MS' ". ($request == 'MS' ? 'selected' : '') .">Mississippi</option>"
	. "<option value='MO' state='MO' ". ($request == 'MO' ? 'selected' : '') .">Missouri</option>"
	. "<option value='MT' state='MT' ". ($request == 'MT' ? 'selected' : '') .">Montana</option>"
	. "<option value='NE' state='NE' ". ($request == 'NE' ? 'selected' : '') .">Nebraska</option>"
	. "<option value='NV' state='NV' ". ($request == 'NV' ? 'selected' : '') .">Nevada</option>"
	. "<option value='NH' state='NH' ". ($request == 'NH' ? 'selected' : '') .">New Hampshire</option>"
	. "<option value='NJ' state='NJ' ". ($request == 'NJ' ? 'selected' : '') .">New Jersey</option>"
	. "<option value='NM' state='NM' ". ($request == 'NM' ? 'selected' : '') .">New Mexico</option>"
	. "<option value='NY' state='NY' ". ($request == 'NY' ? 'selected' : '') .">New York</option>"
	. "<option value='NC' state='NC' ". ($request == 'NC' ? 'selected' : '') .">North Carolina</option>"
	. "<option value='ND' state='ND' ". ($request == 'ND' ? 'selected' : '') .">North Dakota</option>"
	. "<option value='OH' state='OH' ". ($request == 'OH' ? 'selected' : '') .">Ohio</option>"
	. "<option value='OK' state='OK' ". ($request == 'OK' ? 'selected' : '') .">Oklahoma</option>"
	. "<option value='OR' state='OR' ". ($request == 'OR' ? 'selected' : '') .">Oregon</option>"
	. "<option value='PA' state='PA' ". ($request == 'PA' ? 'selected' : '') .">Pennsylvania</option>"
	. "<option value='RI' state='RI' ". ($request == 'RI' ? 'selected' : '') .">Rhode Island</option>"
	. "<option value='SC' state='SC' ". ($request == 'SC' ? 'selected' : '') .">South Carolina</option>"
	. "<option value='SD' state='SD' ". ($request == 'SD' ? 'selected' : '') .">South Dakota</option>"
	. "<option value='TN' state='TN' ". ($request == 'TN' ? 'selected' : '') .">Tennessee</option>"
	. "<option value='TX' state='TX' ". ($request == 'TX' ? 'selected' : '') .">Texas</option>"
	. "<option value='UT' state='UT' ". ($request == 'UT' ? 'selected' : '') .">Utah</option>"
	. "<option value='VT' state='VT' ". ($request == 'VT' ? 'selected' : '') .">Vermont</option>"
	. "<option value='VA' state='VA' ". ($request == 'VA' ? 'selected' : '') .">Virginia</option>"
	. "<option value='WA' state='WA' ". ($request == 'WA' ? 'selected' : '') .">Washington</option>"
	. "<option value='WV' state='WV' ". ($request == 'WV' ? 'selected' : '') .">West Virginia</option>"
	. "<option value='WI' state='WI' ". ($request == 'WI' ? 'selected' : '') .">Wisconsin</option>"
	. "<option value='WY' state='WY' ". ($request == 'WY' ? 'selected' : '') .">Wyoming</option>"
	. "</select>";

	return $stateselect;
}