<?php

function alwp_add_custom_metabox(){

    add_meta_box(
        'alwp_meta',
        'Project Listing',
        'alwp_meta_callback',
        'project',
        'normal',
        'core'
    );
}

add_action( 'add_meta_boxes','alwp_add_custom_metabox');


//****POST ARE BEING STORED IN WP-POST*******//
//Renders the custom meta box and allows you to add fields to the box
function alwp_meta_callback( $post ){
    //To ensure the data came from my form rather then another source potentially malicious
    wp_nonce_field( basename( __FILE__ ), 'alwp_projects_nonce' );
	$alwp_stored_meta = get_post_meta( $post->ID ); //Queries the database
    //var_dump($alwp_stored_meta); //is equal to sout in java.
    //die(); // with var_dump to display corectly as it removes everything
    ?>
    
    <!--Now I can write HTML
    <div>Test</div>-->
    <div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="project-id" class="alwp-row-title"><?php _e( 'project Id', 'wp-project-listing' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="alwp-row-content" name="project_id" id="project-id"
				value="<?php if ( ! empty ( $alwp_stored_meta['project_id'] ) ) {
					echo esc_attr( $alwp_stored_meta['project_id'][0] ); //esc_attr strips all special or invalid characters
				} ?>"/>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="date-listed" class="alwp-row-title"><?php _e( 'Date Listed', 'wp-project-listing' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" size=10 class="alwp-row-content datepicker" name="date-listed" id="date-listed" value="<?php if ( ! empty ( $alwp_stored_meta['date_listed'] ) ) echo esc_attr( $alwp_stored_meta['date_listed'][0] ); ?>"/>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="application-deadline" class="alwp-row-title"><?php _e( 'Application Deadline', 'wp-project-listing' ) ?></label>
			</div>
			<div class="meta-td">
				<input type="text" size=10 class="alwp-row-content datepicker" name="application-deadline" id="application-deadline" value="<?php if ( ! empty ( $alwp_stored_meta['application_deadline'] ) ) echo esc_attr( $alwp_stored_meta['application_deadline'][0] ); ?>"/>
			</div>
		</div>
		<div class="meta">
			<div class="meta-th">
				<span><?php _e( 'Principle Duties', 'wp-project-listing' ) ?></span>
			</div>
		</div>
		<div class="meta-editor"></div>
		<?php
		$content = get_post_meta( $post->ID, 'principal_duties', true );
		$editor = 'principal_duties';
		$settings = array(
			'textarea_rows' => 8,
			'media_buttons' => false,
		);
		wp_editor( $content, $editor, $settings); ?>
		</div>
		<div class="meta-row">
	        <div class="meta-th">
	          <label for="minimum-requirements" class="alwp-row-title"><?php _e( 'Project Description', 'wp-project-listing' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="minimum-requirements" class="alwp-textarea" id="minimum-requirements"><?php
	          if ( ! empty ( $alwp_stored_meta['minimum_requirements'] ) ) {
		          echo esc_attr( $alwp_stored_meta['minimum_requirements'][0] );
	          }
	          ?>
	          </textarea>
	        </div>
	    </div>
	    <div class="meta-row">
	        <div class="meta-th">
	          <label for="relocation-assistance" class="alwp-row-title"><?php _e( 'Relocation Assistance', 'wp-project-listing' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <select name="relocation-assistance" id="relocation-assistance">
		          <option value="Yes" <?php if ( ! empty ( $alwp_stored_meta['relocation_assistance'] ) ) selected( $alwp_stored_meta['relocation_assistance'][0], 'Yes' ); ?>><?php _e( 'Yes', 'wp-project-listing' )?></option>';
		          <option value="No" <?php if ( ! empty ( $alwp_stored_meta['relocation_assistance'] ) ) selected( $alwp_stored_meta['relocation_assistance'][0], 'No' ); ?>><?php _e( 'No', 'wp-project-listing' )?></option>';
	          </select>
	    </div> 
	</div>	

<?php

    function alwp_meta_save( $post_id ) {
	// Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'alwp_projects_nonce' ] ) && wp_verify_nonce( $_POST[ 'alwp_projects_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if ( isset( $_POST[ 'project_id' ] ) ) {
    	update_post_meta( $post_id, 'project_id', sanitize_text_field( $_POST[ 'project_id' ] ) );
    }
    if ( isset( $_POST[ 'date_listed' ] ) ) {
    	update_post_meta( $post_id, 'date_listed', sanitize_text_field( $_POST[ 'date_listed' ] ) );
    }
    if ( isset( $_POST[ 'application_deadline' ] ) ) {
    	update_post_meta( $post_id, 'application_deadline', sanitize_text_field( $_POST[ 'application_deadline' ] ) );
    }
    if ( isset( $_POST[ 'principal_duties' ] ) ) {
    	update_post_meta( $post_id, 'principle_duties', sanitize_text_field( $_POST[ 'principle_duties' ] ) );
    }
	if ( isset( $_POST[ 'preferred_requirements' ] ) ) {
		update_post_meta( $post_id, 'preferred_requirements', wp_kses_post( $_POST[ 'preferred_requirements' ] ) );
	}
	if ( isset( $_POST[ 'minimum_requirements' ] ) ) {
		update_post_meta( $post_id, 'minimum_requirements', wp_kses_post( $_POST[ 'minimum_requirements' ] ) );
	}
	if ( isset( $_POST[ 'relocation_assistance' ] ) ) {
		update_post_meta( $post_id, 'relocation_assistance', sanitize_text_field( $_POST[ 'relocation_assistance' ] ) );
	}
}
add_action( 'save_post', 'alwp_meta_save' );
}