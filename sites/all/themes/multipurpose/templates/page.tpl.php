<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
  global $user, $base_url;?>
 <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel='stylesheet' type='text/css'>
<link href="<?php echo $base_url?>/sites/all/themes/multipurpose/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<?php

if (!empty($messages)): ?>
                    <div id="messages">
                      <?php print render($messages); ?>
                    </div>
                <?php endif; 
 ?>

 
<?php 
//To add Placeholder and hide submit button of search
function multipurpose_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    // HTML5 placeholder attribute
    $form['search_block_form']['#attributes']['placeholder'] = t('Search...');
    $form['actions']['#attributes']['class'][] = 'element-invisible';
    $vars['theme_hook_suggestions'][] = 'search-results--node.tpl';
  }
}
 
?> 
 <?php 

/*$t = form_get_errors();
echo $t['subscribe'];*/?>
<?php include 'headerPage.tpl.php';?>
<section class="content-wrapper articles" id="wrap" >
    <div class="row" id= "main">
        <div class="container">
            <div class="col-md-lt">
 <?php if ($tabs && isset($user->name)): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
 <?php print render($page['content']); ?> </div>
            <div class="col-md-rt"> <?php 
                $sidebarclass = ""; 
                if($page['sidebar_first']) $sidebarclass="left-content";
                if ($page['sidebar_first']): ?>
                    <aside id="secondary" class="sidebar-container" role="complementary"> <?php 
                       print render($page['sidebar_first']); ?>
                    </aside> <?php 
                endif; ?>
            </div>
        </div>
    </div>
</section><?php 

if ($page['footer']): ?>
    <div class="span_1_of_1 col col-1"> <?php 
        print render($page['footer']); ?>
    </div><?php 

endif; ?>
