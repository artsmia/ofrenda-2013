<?php
$phase = get_query_var('phase');
if($phase){
	wp_redirect(home_url()."/videos/#phase_".$phase);
} else {
	wp_redirect(home_url()."/videos");
}
die;
?>