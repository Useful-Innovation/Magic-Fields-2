<?php
// initialisation
global $mf_domain;


// class with static properties encapsulating functions for the field type

class file_field extends mf_custom_fields {

  public $allow_multiple = TRUE;
  public $has_properties = FALSE;

  function get_properties() {
    return  array(
      'js'  => TRUE,
      'js_dependencies' => array(), 
      'css' => FALSE
    );
  }
  
  public function _update_description(){
    global $mf_domain;
    $this->description = __("Simple input file",$mf_domain);
  }

  public function display_field( $field, $group_index = 1, $field_index = 1){
    global $mf_domain;
    
    $field_style = '';
    $imageThumbID = "img_thumb_".$field['input_id']; 
    if(!$field['input_value']){
      //ToDo: remplazar por una imagen que sea "no file"
      $value = sprintf('%simages/noimage.jpg',MF_URL);
      $field_style = 'style="display:none;"';
    }else{
      $value = sprintf('%simages/noimage.jpg',MF_URL);
      //$value = sprintf("%s?src=%s%s&w=150&h=120&zc=1",PHPTHUMB,MF_FILES_URL,$field['input_value']);
    }
 
    $value  = sprintf('<img src="%s" id="%s" />',$value,$imageThumbID);

    $out  = '<div class="file_layout">';
    $out .= '<div class="file_preview">';
    /***
     *  Mod from Useful Innovation. 
     *  Read ui-plugins/ui-magic-fields-2/README.md for more info 
     *  @author Emil Lunnergård
     */
    $img_sub_path = '/images/icons/file-types/48/';
    $ui_filename  = substr($field['input_value'], 10);
    $ui_extension = pathinfo($ui_filename, PATHINFO_EXTENSION);
    $icon         = (file_exists(get_theme_root() . '/' . get_template() . $img_sub_path . $ui_extension . '.png') ? $ui_extension : 'file');
    $ui_output  = '<h3 style="text-align: center;">Vald fil</h3>';
    $ui_output .= '<div class="ui_file_field" style="padding-top: 10px;text-align: center; min-height: 78px;line-height: 1em;' . (!strlen($ui_filename) ? 'visibility: hidden;' : '') . '">';
    $ui_output .= '
      <a style="text-decoration: none;" href="' . MF_FILES_URL.$field['input_value'] . '" target="_blank" class="mf-file-view ui_file_link" >
        <img id="ui_file_icon" src="' . get_bloginfo('template_directory') . $img_sub_path . $icon . '.png" />
        <br />
        <span class="ui_file_name">' . $ui_filename . '</span>
      </a>
    ';
    $ui_output .= '</div>';
    $out .= $ui_output;
    /* * * * * * * * * * * * * * * * * * * * * * */
    $out .= sprintf('<div id="photo_edit_link_%s"  %s class="photo_edit_link">',$field['input_id'],$field_style);
    $out .= sprintf('<a href="%s" target="_blank" id="edit-%s" class="mf-file-view" >%s</a> | ',MF_FILES_URL.$field['input_value'],$field['input_id'],__('View',$mf_domain));
    $out .= sprintf('<a href="#remove" class="remove remove_file" alt="%s" id="remove-%s" >%s</a>',__('Are you sure?', $mf_domain),$field['input_id'],__('Delete',$mf_domain));
    $out .= '</div>';
    $out .='</div>';
    $out .= '<div class="file_input">';
    $out .= '<div class="mf_custom_field">';
    $out .= sprintf('<div id="response-%s" style="display:none;" ></div>',$field['input_id']);
    $out .= sprintf('<input type="hidden" value="%s" name="%s" id="%s" %s >',$field['input_value'],$field['input_name'],$field['input_id'],$field['input_validate']);
    $out .= $this->upload($field['input_id'],'file','mf_file_callback_upload');
    $out .= '</div></div>';
    $out .= '</div> <!-- /.file_layout -->';
    return $out;
  }
  
}
