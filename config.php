<?php
// PLUGIN CONFIGURATION

/**
 * @name get_custom_excerpt
 * Funzione che restituisce l'excerpt di un post lungo in base al numero di caratteri passato come parametro 
 * @param $limit numero di caratteri
 * @return excerpt "limitato" del post corrente
 * 
 */
function get_custom_excerpt($limit) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if( count( $excerpt ) >= $limit) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ).'...';
	} 
	else {	
		$excerpt = implode( " ",$excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`' , '', $excerpt );
	return $excerpt;
}

?>