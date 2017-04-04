<?php
//Dynamically update the list as location posts are added
//content object was never used but I left it in for educational purposes could be used in the future
function alwp_project_taxonomy_list( $atts, $content = null ) {
	$atts = shortcode_atts( 
		array(
			'title' => 'Completed projects by location:'
		), $atts
	);
	//using my custom taxonmy term location object
	$locations = get_terms( 'location' );
	//if locations is not empty and it doesnt return an error EXECUTE 
	if( ! empty( $locations ) && ! is_wp_error( $locations ) ) {
		$locationlist = '<div id="project-location-list">';
		//Retrieves the translation of $text and escapes it for safe use in HTML. 
		//If there is no translation, or the domain isn't loaded, the original text is returned
		$locationlist .= '<h3>' . esc_html__( $atts[ 'title' ] ) . '</h3>';
		//.= adds it to the end of the string
		$locationlist .= '<ul>';
		// let locations of location *ngFor ;)
		foreach( $locations  as $location ) {
			$locationlist .= '<h4><li class="project-location">';
			//get_term_link function can use term object/term ID/term slug I used term object
			//esc_url is identical to esc_html
			$locationlist .= '<a href="' . esc_url( get_term_link( $location ) ) . '">';
			$locationlist .= esc_html__( $location->name ) . '</a></li></h4>';
		}
	$locationlist .= '</ul></div>';
	}
	return $locationlist;
	//var_dump is your best friend during development to display test content like location taxonomy
	//var_dump($location)
}
add_shortcode( 'project_location_list', "alwp_project_taxonomy_list" );
//hide_empty parameter is not needed as it is set to true by default 

//******This is the html used above just translated to php to work with wordpress**********//
// <div id="project-location-list">
// 	<h3>This is the title</h3>
// 	<ul>
// 		<li class="project-location"><a href="#">Location1</a></li>
// 		<li class="project-location"><a href="#">Location2</a></li>
// 		<li class="project-location"><a href="#">etc....</a></li>
// 	</ul>
// </div>

//IN THE FUTURE ADD CODE HERE TO DISPLAY THE PROJECT LISTINGS IN A TABLE