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
 */?>
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel='stylesheet' type='text/css'>
<?php if (!empty($messages)): ?>
                    <div id="messages">
                      <?php print render($messages); ?>
                    </div>
                <?php endif; 
 global $user, $base_url; ?>
<?php
    $cookie_name = "logincookie";    
    $cookie_value = 0;
?>
<html>
<body>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<?php 
 
if((!isset($user->name))){
   if(!isset($_COOKIE[$cookie_name])) {
      $cookie_value = 1;
      setcookie($cookie_name, $cookie_value);
    } else { 
          $cookie_value =  $_COOKIE[$cookie_name] + 1;
          setcookie($cookie_name, $cookie_value);
     }
    
}
  
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
}?>
 <?php 

/*$t = form_get_errors();
echo $t['subscribe'];*/?>
<header id="header" >
    <div class="container clearfix">
        <div class="row">             
            <?php if (theme_get_setting('image_logo','multipurpose')): ?>
            <?php if ($logo): ?>
                <h1 id="site-logo">
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" id="logo">
                        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
                    </a>
                </h1>
            <?php endif; ?>
            <?php else: ?>
                <h1 id="site-name">
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" id="logo">
                        <?php print $site_name; ?>
                    </a>
                </h1>
                <?php if ($site_slogan): ?>
                    <h1 id="site-slogan">
                        <?php print $site_slogan; ?>
                    </h1>
                <?php endif; ?> 
            <?php endif; ?>
            <nav>
                <span class="user-log">
                   <?php if(isset($user->name)){ 
                        $account = user_load($user->uid);
			if(isset($account->field_first_name['und'][0]['safe_value']) )
                           echo "Welcome ".$account->field_first_name['und'][0]['safe_value']."!"; 
                        else echo "Welcome ". $user->name."!";}?>
                </span> 
                <ul>
                    <li><a  href="https://www.fia.org" target="_blank">Fia </a></li>
                    <li>
                        <a id = "clickSearch">Search</a>
                        <span id="searchClicked" style="display:none">
                            <?php
                                $block = module_invoke('search', 'block_view', 'search');
                                print render($block);
                            ?>
                        </span>
                     </li>
                 <li>
                    <?php 
                    if(isset($user->name)){?><a href="#" class="active">MY account</a><?php } 
                    else{ ?><div class="userregister"> <a href="?q=user" class="active">Login</a>/<a href="?q=user/register" class="active">Register</a></div><?php }?>
                  </li>
                    <li><a href="https://fimag.fia.org/issue-archives" target="_blank">Archive</a></li>
                    <li><a target="_blank"  href="<?php echo $base_url.'/'.path_to_theme()?>/pdf/MarketVoice_MediaKit_2015v2.pdf">Advertise</a></li>
<?php  if(isset($user->name)){?>
<li><a href="?q=user/logout">Logout</a></li><?php }?>
                </ul>
           </nav>
        </div>
    </div>
</header>
<section class="content-wrapper" id="wrap" >
    <div class="container clearfix" id= "main">
        <div class="row">
            <div class="col-md-lt"> <?php print render($page['content']); ?> </div>
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


<!-- Button trigger modal -->
<button type="button" id = "subscribeBtn" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" data-backdrop="static" style="display:none"></button>
<!-- button type="button" id = "Messagedialog" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" data-backdrop="static" style="display:none"></button>
-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> </h4>
      </div>
      <div class="modal-body"></div>
      <!-- div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div-->
    </div>
  </div>
</div>
<a id = "registerdialog" class="ctools-use-modal ctools-modal-modal-popup-medium" href="modal_forms/nojs/register" style="display:none"></a>
<a id = "logindialog" class="ctools-use-modal ctools-modal-modal-popup-medium" href="modal_forms/nojs/login" style="display:none"></a>

<span id = "subscribePopup" style = "display:none"> 
    <?php $block = module_invoke('total_subscription', 'block_view', 'susbcription_block');
print render($block['content']);?>
</span>

<span id = "MessagePopup" style = "display:none"> 
    It seems that you are not registered with Marketvoice.org. Please  <a id= "registerdial" class="cursor">Register</a> or if you are already registered <a id= "logindial" class="cursor">Sign IN</a> here. 
</span>

<span id = "errorMsgPopup" style = "display:none"> 
<?php if (!empty($messages)): ?>
                    <div id="messages">
                      <?php print render($messages); ?>
                    </div>
                <?php endif; ?></span>
