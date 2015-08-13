<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */


 global $base_url;
$site_frontpage = variable_get('site_frontpage', 'node');
list($first, $second) = explode('/', $site_frontpage, 2);
if ($first == 'node' && is_numeric($second)) {
  $front_node = $second;
} else {
  // It's not a node page.
}
?>
<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<?php endif; ?>
  <?php if (!$page): ?>
      <header>
  <?php endif; ?>
      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
      <h2 class="title" <?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
     <?php if (!$page): ?>
      </header>
  <?php endif; ?>

<h2><?php if(isset($_REQUEST['t'])) echo "Top Story"?> <span><?php print $title; ?></span>

<?php $field_name = 'field_sub_title';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {?>
                        <span class="subtitle">
<?php print $field[0]['value']?></span><?php }?></h2>

<?php $author = '';
        $field_name = 'field_add_author';
        $field= field_get_items('node', $node, $field_name); 
         for($i = 0; $i<sizeof($field); $i++)
         {
            $author_id = $field[$i]['target_id'];
if($author_id ){
            $title = db_query("SELECT n.title, fdb.body_value from node n LEFT JOIN field_data_body fdb ON n.nid = fdb.entity_id where n.nid = $author_id ");
            $url = db_query("SELECT ua.alias from url_alias ua where ua.source = 'node/$author_id' ");
            foreach($url as $url1) $url_alias = $url1->alias;
            foreach($title as $title1)
            {  
                if(strip_tags($title1->body_value) == "" ) $author.=  $title1->title.", ";
                else $author.= "<a href='$base_url?q=$url_alias'>".$title1->title."</a>".", " ; 
            } 
         }
    
}?>
<?php /*if($author) {?><span class="author"> <?php echo "By ". rtrim($author, ", "); ?> </span> <?php } */?>
<span class="author"> 
<?php 
 $query = db_query("Select field_date_value from field_data_field_date where entity_id = $front_node");
foreach($query as $data)  $publishDate = $data->field_date_value; 

 if($author) {?><?php echo "By ".  rtrim($author, ", ") . " | "; ?> <?php }?> <?php echo gmdate("F d, Y", $publishDate);?></span> 

<?php $field_name = 'field_news_deck_text';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {?>
                        <span class="decktext"><i>
<?php print $field[0]['value']?></i></span><?php }?>

 
<div class="widget-area-txt">
    <p><?php print render($content['body']);?> </p>
    <div class="widget-contents clearfix"><?php 
        $field_name = 'field_left_side_bar';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {?>
            <div class="blue-container align-left width-small"><?php
                print $field[0]['value'];?>
            </div>
            <?php 
                $field_name = 'field_right_sidebar';
                $field= field_get_items('node', $node, $field_name);
                print $field[0]['value'];?> 
            <?php 
        }?>
    </div>
                         
<div class="widget-contents clearfix"> 
<?php /*Added sidebar*/?>
<?php $field_name = 'field_add_text_sidebar';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {?>

                             
                              
                              <div class="content-container-aside">
                                   <div class="widget-business-story align-left width-small">
                                  <h3><?php print $field[0]['value'];?></h3>
<?php $field_name = 'field_add_text_sidebar_head';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {?>
                                <div class="secodary-head">
<h6><?php print $field[0]['value'];?></h6>
<?php 
$field_name = 'field_add_text_sidebar_small_hea';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {
                                    print $field[0]['value'];}?>
                                </div>
<?php }?></div></div>
                            
             <?php }?>
<?php $field_name = 'field_add_text_right_sidebar';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) { print $field[0]['value'];}?>
</div>
<div class="widget-multiple-list cleartfix">
<?php $field_name = 'field_add_text_after_sidebar';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {print $field[0]['value'];}?>

     </div> 


<div class="widget-contents clearfix"> 
<?php /*Added sidebar*/?>
<?php $field_name = 'field_add_text_sidebar1';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) {?>

                             
                              
                              <div class="content-container-aside">
                                   <div class="widget-business-story align-left width-small">
                                  <h3><?php print $field[0]['value'];?></h3>
<?php $field_name = 'field_add_text_sidebar_head1';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) { ?>
                                <div class="secodary-head">
 <h6><?php print $field[0]['value'];?></h6>
                                  <?php $field_name = 'field_add_text_sidebar_small1';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) { print $field[0]['value'];}?>
                                </div>
<?php }?></div></div>
                            
             <?php }?>
<?php $field_name = 'field_add_text_right_sidebar1';
        $field= field_get_items('node', $node, $field_name); 
        if( $field[0]['value']) { print $field[0]['value'];}?>
</div>
 





    <div class="clearfix"><p> <?php 
        $field_name = 'field_after_sidebar';
        $field= field_get_items('node', $node, $field_name);
        print $field[0]['value']; ?> </p> 
    </div>
     
 <?php $field_name = 'field_bottom_side_bar';
        $field= field_get_items('node', $node, $field_name);
if($field[0]['value']){?>
 <div class="large-side-bar width-full">
 <?php            
$field_name = 'field_title_bottom_bar';
        $field= field_get_items('node', $node, $field_name);
if($field[0]['value']){?><h6><?php echo $field[0]['value']?></h6> <?php }?>
 
 <?php $field_name = 'field_bottom_side_bar';
        $field= field_get_items('node', $node, $field_name);
        print $field[0]['summary'];?>
             <a href="#" id="mySlideToggler">Read More</a> 
              <span id="mySlideContent" style = "display:none">
                  <?php  print $field[0]['value'];?>
<a id="ClickTOggle">Read Less</a>
                </span>
                
                </p>
            </div>
 <?php }?>



 <?php 
  /*  $field_name = 'field_video';
    $field= field_get_items('node', $node, $field_name); 
    if( $field[0]['filename']){?>
	<div class="video-player">
	<video width="100%" controls>
	    <source src="<?php echo $base_url.'/'. variable_get('file_public_path', conf_path() . '/files/'). $field[0]['filename']?>" type="video/mp4">Your browser does not support HTML5 video.
	</video>
		            
	</div><?php 
    }

*/


    $field_name = 'field_attachment';
    $field= field_get_items('node', $node, $field_name); 
    if( $field[0]['filename']){?>
        <div class="clearfix"><p>  
            <input type="hidden" value = "<?php echo $base_url.'/'. variable_get('file_public_path', conf_path() . '/files/'). $field[0]['filename']?>" id = "attachment1">
            <input type="hidden" value = "<?php echo $field[0]['filename']?>" id = "file1">
            <a href="#"  id="attachmentDownload" >Attachment1</a>
            </p> 
        </div><?php
    }?>
</div>
<?php if (!empty($content['links'])): ?>
    <footer>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
<?php if (!$page): ?>
  </article> <!-- /.node -->
<?php endif; ?>
