<?php
/*
 * rendering product meta on product page
*/

global $nmcontact;

$single_form = $nmcontact -> get_forms( $nmcontact -> form_id );
//$nmcontact -> pa($single_form);

$nmcontact -> allow_file_upload = $single_form -> allow_file_upload;

$existing_meta 		= json_decode( $single_form -> the_meta, true);

//webcontact_pa($existing_meta);

if($existing_meta){
?>

<style>
<?php
/*
 * pasting the custom css if used in form settings
 */
echo stripslashes( strip_tags($single_form -> form_style));
?>
</style>

<?php

echo '<form id="webcontact-'.$nmcontact -> form_id .'"';
echo 'onsubmit = "return send_data(this)"';
echo 'data-form="'.esc_attr( $single_form -> the_meta ).'" class="form-horizontal">';
echo '<div id="nm-webcontact-box-'. $nmcontact->form_id .'" class="nm-webcontact-box">';


		/*
		 * forms extra information being sent hidden
		*/
		echo '<input type="hidden" name="_form_id" value="'.$nmcontact -> form_id.'">';
		echo '<input type="hidden" name="_sender_email" value="'.$single_form -> sender_email.'">';
		echo '<input type="hidden" name="_sender_name" value="'.$single_form -> sender_name.'">';
		echo '<input type="hidden" name="_subject" value="'.$single_form -> subject.'">';
		echo '<input type="hidden" name="_receiver_emails" value="'.$single_form -> receiver_emails.'">';
		//echo '<input type="hidden" name="_reply_to" value="'.$single_form -> reply_to.'">';
		echo '<input type="hidden" name="_send_file_as" value="'.$single_form -> send_file_as.'">';
		echo '<input type="hidden" name="_photo_editing" value="'.$single_form -> photo_editing.'">';
		echo '<input type="hidden" name="_aviary_api_key" value="'.$single_form -> aviary_api_key.'">';
		echo '<input type="hidden" name="_success_message" value="'.stripslashes($single_form ->success_message).'" />';
		echo '<input type="hidden" name="_error_message" value="'.stripslashes($single_form -> error_message).'" />';

		$row_size = 0;

		$started_section = '';

		foreach($existing_meta as $key => $meta)
		{

			$type = $meta['type'];

			$name = strtolower(preg_replace("![^a-z0-9]+!i", "_", $meta['data_name']));


			if(($row_size + intval($meta['width'])) > 100 || $type == 'section'){

				echo '<div style="clear:both; margin: 0;"></div>';

				if($type == 'section'){
					$row_size = 100;
				}else{

					$row_size = intval( $meta['width'] );
				}

			}else{

				$row_size += intval( $meta['width'] );
			}


			$show_asterisk 		= ($meta['required']) ? '<span class="show_required"> *</span>' : '';
			$show_description	= ($meta['description']) ? '<span class="show_description">'.stripslashes($meta['description']).'</span>' : '';

			$field_label = $meta['title'] . $show_asterisk . $show_description;

			switch($type)
			{
				case 'hidden':
					echo '<input type="hidden" name="'.$name.'" id="'.$name.'"';
					echo 'value="'.$meta['field_value'].'" data-type="'.$type.'" />';

					break;

				case 'text':
					echo '<div class="form-group">';
					echo '<div class="col-sm-6">';
					echo '<input type="text" name="'.$name.'" id="'.$name.'" class="form-control"';
					echo 'value="'.$value.'" data-type="'.$type.'"';
					echo 'data-req="'.$meta['required'].'"';
					echo 'data-message="'.stripslashes( $meta['error_message'] ).'" />';
					echo '</div>';
					echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.' </label>';
					echo '</div>';

					//for validation message
					echo '<span class="errors"></span>';

					break;

				case 'date':
					echo '<input type="text" name="'.$name.'" id="'.$name.'"';
					echo 'value="'.$value.'" data-type="'.$type.'"';
					echo 'data-req="'.$meta['required'].'"';
					echo 'data-message="'.stripslashes( $meta['error_message'] ).'"';
					echo 'data-format="'.stripcslashes($meta['date_formats']).'" />';
					echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.' </label>';
					echo '</div>';

					//for validation message
					echo '<span class="errors"></span>';

					break;

				case 'email':
					echo '<div class="form-group">';
					echo '<div class="col-sm-6">';
					echo '<input type="email" id="'.$name.'" name="'.$name.'" class="form-control"';
					echo 'value="'.$value.'" data-type="'.$type.'"';
					echo 'data-req="'.$meta['required'].'"';
					echo 'data-sendemail="'.$meta['send_email'].'"';
					echo 'data-message="'.stripslashes( $meta['error_message'] ).'" />';
					echo '</div>';
					echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.' </label>';
					echo '</div>';

					//for validation message
					echo '<span class="errors"></span>';

					break;

				case 'checkbox':
					$opts = explode("\n", $meta['options']);
					$defaul_checked = explode("\n", $meta['checked']);


					echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.' </label>';
					foreach($opts as $opt)
					{
						if($defaul_checked){
							if(in_array($opt, $defaul_checked))
								$checked = 'checked="checked"';
							else
								$checked = '';
						}

						$output = stripslashes(trim($opt));
					echo '<label for="f-meta-'. $opt.'"> <input type="checkbox"';
					echo 'value="'.$opt.'" id="f-meta-'. $opt.'"';
					echo 'name="'.$name.'[]" '. $checked.'';
					echo 'data-req="'.$meta['required'].'"';
					echo 'data-message="'.stripslashes( $meta['error_message'] ).'">';

					echo $output;
					echo '</label>';

					}
					//for validation message
					echo '<span class="errors"></span>';

					break;

				case 'select':
					$opts = explode("\n", $meta['options']);
					$default_selected = $meta['selected'];


					echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.' </label>';
					echo '<select id="'.$name.'" name="'.$name.'"';
					echo 'data-req="'.$meta['required'].'"';
					echo 'data-message="'.stripslashes( $meta['error_message'] ).'">';
						echo '<option value="">'.__('Select option', $nmcontact -> plugin_meta['shortname']).'</option>';

						foreach($opts as $opt)
						{

							$selected = ($opt == $default_selected) ? 'selected="selected"' : '';

							$output = stripslashes(trim($opt));

							echo '<option value="'.$opt.'" '. $selected.'>';
							echo $output;
							echo '</option>';
						}
						echo '</select>';

						//for validation message
						echo '<span class="errors"></span>';

					break;

				case 'radio':
					$opts = explode("\n", $meta['options']);
					$default_selected = $meta['selected'];


					echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.' </label>';

					foreach($opts as $opt)
					{
						$checked = ($opt == $default_selected) ? 'checked="checked"' : '';

						$output = stripslashes(trim($opt));
						echo '<label for="f-meta-'. $opt.'"> <input type="radio"';

						echo 'value="'.$opt.'" id="f-meta-'. $opt.'"';
						echo 'name="'.$name.'" '. $checked.'';
						echo 'data-req="'.$meta['required'].'"';
						echo 'data-message="'.stripslashes( $meta['error_message'] ).'">';
						echo $output;

						echo '</label>';
					}

					//for validation message
					echo '<span class="errors"></span>';

					break;

				case 'textarea':

					echo '<div class="form-group">';
					echo '<div class="col-sm-6">';
					echo '<textarea id="'.$name.'" style="width: 90%; height: 70px" class="form-control"';
					echo 'name="'.$name.'" data-req="'.$meta['required'].'"';
					echo 'data-message="'.stripslashes( $meta['error_message'] ).'" wrap="physical"></textarea>';
					echo '</div>';
					echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.' </label>';
					echo '</div>';

					//for validation message
					echo '<span class="errors"></span>';

					break;

				case 'section':

					if($started_section)		//if section already started then close it first
						echo '</section>';

					$started_section = 'webcontact-section-'.$name;

					echo '<section id="'.$started_section.'">';
					echo '<div style="clear: both"></div>';

					echo '<h4>'. stripslashes( $meta['title'] ).'</h4>';
					echo '<p>'. stripslashes( $meta['description']).'</p>';

					echo '<div style="clear: both"></div>';

					break;

				case 'file':

					echo '<div class="form-group">';
						echo '<div class="col-sm-6">';

							echo '<div id="nm-uploader-area-'. $name.'" >';
								echo '<div id="wrapper-uploadifive-button">';
									echo '<input id="'.$name.'"';
									echo 'name="'.$name.'" data-req="'.$meta['required'].'"';
									echo 'data-message="'.stripslashes( $meta['error_message'] ).'" type="file" />';
								echo '</div>';

								echo '<input type="hidden" id="files_'. $name.'"';
								echo 'name="files_'. $name.'">';
								echo '<span id="upload-response-'. $name.'"></span>';

								echo '<p id="uploaded_files-'. $name.'"';
								echo 'style="margin-bottom: 2px;"></p>';

								echo '<span class="errors"></span>';

							echo '<script type="text/javascript">';

							echo 'setup_uploader(\''.$name.'\',
								\''. stripslashes($meta['button_label']).'\',
								\''. stripslashes($meta['files_allowed']).'\',
								\''. stripslashes($meta['file_types']).'\',
								\''. stripslashes($meta['file_size']).'\',
								\''. stripslashes($meta['button_width']).'\',
								\''. stripslashes($meta['photo_editing']).'\',
								\''. get_editing_tools($meta['editing_tools']).'\')';
							echo '</script>';
						echo '</div>';

						echo '<label for="'.$name.'" class="col-sm-6 control-label">'. $field_label.'</label>';

						echo '</div>';
					echo '</div>';

				break;

			}
		}


		echo '<div style="clear: both"></div>';

	echo '</div>';  //ends nm-webcontact-box


	echo '<p class="webcontact-save-button"><input type="submit" class="'.$single_form -> button_class.'" value="'.$single_form -> button_label.'"></p>';
	echo '<span id="nm-sending-form"></span>';
	wp_nonce_field('doing_contact','nm_webcontact_nonce');
	echo '</form>';
}

	//	<!-- if section_slides = yes  -->

	if($single_form -> section_slides == 'on'){

	echo '<table>';
		echo '<tr>';
			echo '<td style="text-align: left; width: 10%"><a href="#!" id="slide_back"><img';
					echo 'border="0" width="32"';
					echo 'src="'.$nmcontact -> plugin_meta['url'].'/images/left-arrow.png">';
			echo '</a>';
			echo '</td>';
			echo '<td></td>';
			echo '<td style="text-align: right; width: 10%"><a href="#!"';
				echo 'id="slide_next"><img border="0" width="32"';
					echo 'src="'.$nmcontact -> plugin_meta['url'].'/images/right-arrow.png">';
			echo '</a>';
			echo '</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td colspan="3">';
				echo '<table id="section_titles">';
					echo '<tr>';
					echo '</tr>';
				echo '</table>';
			echo '</td>';

		echo '</tr>';
	echo '</table>';
	}


function get_editing_tools($editing_tools){

	parse_str ( $editing_tools, $tools );
	if ($tools['editing_tools'])
		return implode(',', $tools['editing_tools']);
}

if ($single_form -> aviary_api_key != NULL) {
	echo '<script type="text/javascript" src="http://feather.aviary.com/js/feather.js"></script>';
}

echo '<script type="text/javascript">';
echo 'nm_webcontact_vars.section_slides= \''. $single_form -> section_slides.'\';';
// it is setting up Aviary API
echo 'if(\''.$single_form -> aviary_api_key.'\' != \'\'){';
	echo 'var featherEditor = new Aviary.Feather({';
	       echo 'apiKey			: \''. $single_form -> aviary_api_key.'\',';
	       echo 'apiVersion		: 3,';
	       echo 'theme			: \'dark\','; // Check out our new 'light' and 'dark' themes!
	       echo 'postUrl		: nm_webcontact_vars.ajaxurl+\'?action=nm_webcontact_save_edited_photo\',';
	       echo 'onSave			: function(imageID, newURL) {';
	          echo 'var img = document.getElementById(imageID);';
	           echo 'img.src = newURL;';
	           echo 'featherEditor.close();';
	       echo '},';
	       echo 'onError			: function(errorObj) {';
	           echo 'alert(errorObj.message);';
	       echo '}';
	   echo '});';
echo '}';
echo '</script>';
