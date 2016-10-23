<?php

/**
 * @file
 * Process theme data.
 *
 * Use this file to run your theme specific implimentations of theme functions,
 * such preprocess, process, alters, and theme function overrides.
 *
 * Preprocess and process functions are used to modify or create variables for
 * templates and theme functions. They are a common theming tool in Drupal, often
 * used as an alternative to directly editing or adding code to templates. Its
 * worth spending some time to learn more about these functions - they are a
 * powerful way to easily modify the output of any template variable.
 *
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "dsi" to match
 *    your subthemes name, e.g. if your theme name is "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "dsi".
 * 2. Uncomment the required function to use.
 */


/**
 * Preprocess variables for the html template.
 */
/* -- Delete this line to enable.
function dsi_preprocess_html(&$vars) {
  global $theme_key;

  // Two examples of adding custom classes to the body.

  // Add a body class for the active theme name.
  // $vars['classes_array'][] = drupal_html_class($theme_key);

  // Browser/platform sniff - adds body classes such as ipad, webkit, chrome etc.
  // $vars['classes_array'][] = css_browser_selector();

}
// */


/**
 * Process variables for the html template.
 */
/* -- Delete this line if you want to use this function
function dsi_process_html(&$vars) {
}
// */


/**
 * Override or insert variables for the page templates.
 */

function dsi_preprocess_page(&$vars) {
    drupal_add_js('jQuery.extend(Drupal.settings, { "pathToTheme": "' . file_create_url(path_to_theme()) . '" });', 'inline'); 
    
    if(isset($vars['node']) && $vars['node']->type == 'event'){
       drupal_set_title('');
    }
    if(isset($vars['node']) && $vars['node']->type == 'research'){
       drupal_set_title('Research Projects');
    }
    if(isset($vars['node']) && $vars['node']->type == 'person'){
        $person_term = $vars['node']->field_person_type[LANGUAGE_NONE][0]['tid'];
        $term = taxonomy_term_load($person_term);
        $name = $term->name;
        drupal_set_title('People: ' . $name);
    }
    
    $current_path = explode('/', drupal_get_path_alias());

    if(isset($vars['node']) && $current_path[0] == 'academic-programs' && isset($current_path[1])){
        drupal_set_title("Master's in Data Science");
    }
}
/* -- Delete this line if you want to use these functions
function dsi_process_page(&$vars) {
}
// */


/**
 * Override or insert variables into the node templates.
 */

function dsi_preprocess_node(&$vars) {
    if($vars['type'] == 'home_panel' && $vars['view_mode'] == 'teaser'){
        $uri = $vars['field_panel_image'][LANGUAGE_NONE][0]['uri'];
        /* For Image Styles 
         * $vars['panel_bg_path'] = image_style_url('home_panel_bg', $uri); 
         */
        $vars['panel_bg_path'] = file_create_url($uri);
        
        $panel_type = $vars['field_panel_type'][LANGUAGE_NONE][0]['value'];
        $panel_type= strtolower(str_replace(' ','-',$panel_type));
        
        if(!empty($vars['field_panel_size'])){
            $size = $vars['field_panel_size'][LANGUAGE_NONE][0]['value'];
            $size = strtolower(str_replace(' ','-',$size));
            $vars['classes_array'][] = $size;
        }
        if(!empty($vars['field_panel_color'])){
            $color = $vars['field_panel_color'][LANGUAGE_NONE][0]['value'];
            $color = strtolower(str_replace(' ','-',$color));
            $vars['classes_array'][] = $color;
        }
        $vars['classes_array'][] = t('home-panel');
        $vars['classes_array'][] = $panel_type;
    }
    if($vars['type'] == 'event' && ($vars['view_mode'] == 'default' || $vars['view_mode'] == 'full')){
        if(empty($vars['field_event_image'])){
            $vars['classes_array'][] = t('no-image');
        }
    }
    $no_titles = array(
        'home_panel',
        'research',
        'core_department',
        'affiliated_units',
        'person',
        'event'
    );
    if ((in_array($vars['type'],$no_titles)) && $vars['view_mode'] == 'teaser'){
        $vars['title']='';
    }
}
function dsi_preprocess_views_view(&$vars) {
    if($vars['css_class'] == 'people-grid'){
        drupal_add_css(path_to_theme() . '/css/colorbox.css', array('group' => CSS_THEME, 'weight' => 115));
    }
}

/* -- Delete this line if you want to use these functions
function dsi_process_node(&$vars) {
}
// */


/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function dsi_preprocess_comment(&$vars) {
}
function dsi_process_comment(&$vars) {
}
// */


/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function dsi_preprocess_block(&$vars) {
}
function dsi_process_block(&$vars) {
}
// */
