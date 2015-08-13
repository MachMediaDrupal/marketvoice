<?php
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function multipurpose_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function multipurpose_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
$breadcrumb[] = drupal_get_title();
    $output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}

/**
 * Override or insert variables into the page template.
 */
function multipurpose_preprocess_page(&$vars) {
  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }

if (isset($vars['node']->type)) { $vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;  } 
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function multipurpose_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function multipurpose_preprocess_node(&$variables) {
  $node = $variables['node'];
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  $variables['date'] = t('!datetime', array('!datetime' =>  date('j F Y', $variables['created'])));
}

function multipurpose_page_alter($page) {
  // <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
    'name' =>  'viewport',
    'content' =>  'width=device-width, initial-scale=1, maximum-scale=1'
    )
  );
  drupal_add_html_head($viewport, 'viewport');
}

function multipurpose_user_logout($account){
 echo "<script type='text/javascript'>setCookieRegisterPopup()</script>";
}


/**
 * Process variables for search-result.tpl.php.
 *
 * @see search-result.tpl.php
 */
function multipurpose_preprocess_search_result(&$variables) {
  // Add node object to result, so we can display imagefield images in results.
  $n = node_load($variables['result']['node']->nid);
  $n && ($variables['node'] = $n);
}

function multipurpose_form_user_profile_form_alter(&$form, $form_state) {
   unset($form['timezone']);
 $request_new = l(t('Request new password'), 'user/password', array('attributes' => array('title' => t('Request new password via e-mail.'))));
$form['account']['current_pass']['#description'] = t('Enter yor current password to change the Password. !request_new.', array(  '!request_new' => $request_new));

}
 
function multipurpose_form_user_login_alter(&$form) { 
  $newlinks = l(t('Forgot Password'), 'user/password', array('attributes' => array('title' => t('Request new password via e-mail.'))));
  $registerLinks = l(t('Not Yet Registered?'), 'user/register', array('attributes' => array('title' => t('Click to Register.'))));
  $newlinks = '<div class="wrapperForgotPassword">' . $newlinks . '<span style="padding: 0px 7px 0 7px;"></span>'. $registerLinks. '</div>';
  $form['links']['#markup'] = $newlinks;
  $form['links']['#weight'] = 10000; // put the links after the other items
  return $form;
}

function multipurpose_status_messages($variables) {
 
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );
  foreach (drupal_get_messages($display) as $type => $messages) {
  if( ($messages[0] == "Registration successful. You are now logged in.") || ( $messages[0] == "Further instructions have been sent to your e-mail address." ))
  {
$output = '<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-body">';
$footer = '</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->';
  }
else {
$output = "";
$footer = "";}
    // ! important : adding html needed for the modal.
    
 
    $output .= "<div class=\"_messages $type\">\n";
    if (!empty($status_heading[$type])) {
      $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
    }
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
 
    $output .= $footer;
  }
  return $output;
}
