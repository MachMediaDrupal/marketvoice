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
// print_r($content['field_news_in_this_issue']['#items']  );
 $wrapper = entity_metadata_wrapper('node', $node);
 $formtype = field_get_items('node', $node, 'field_news_in_this_issue');

 

 global $base_url;
 $imagePath =  $base_url."/". drupal_get_path('theme', 'multipurpose');
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
<!-- div class="advertisement-blk">
    <img src="<?php echo $imagePath; ?>/images/ad_728x90.jpg" alt="image">
</div-->
<div class="advertisement-blk">
    <img src="<?php echo $imagePath; ?>/images/animated.gif" alt="image">
</div>
<div class="widget-top-story"> 
    <div class="widget-main-story">
        <h2>Top Story</h2>
        <div class="list-story clearfix"><?php 
            foreach($formtype as $itemid) {  

                $item = field_collection_field_get_entity($itemid);  ?>
                <figure>
<?php if(isset($item->field_top_story['und'][0]['entity']->field_thumbnail['und'][0]['filename'])){?>
                    <img src="<?php echo $base_url.'/sites/default/files/'.$item->field_top_story['und'][0]['entity']->field_thumbnail['und'][0]['filename'];?>" width="83" height="83"/><?php }?>
                </figure> 

		<figcaption>
		    <h6><?php echo $item->field_top_story['und'][0]['entity']->title; ?></h6>
                    <p> <?php
if(isset($item->field_top_story['und'][0]['entity']->field_sub_title['und'][0]['value'])) 
                             print trim($item->field_top_story['und'][0]['entity']->field_sub_title['und'][0]['value']);

                        else if($item->field_top_story['und'][0]['entity']->body['und'][0]['summary']) 
                            print substr($item->field_top_story['und'][0]['entity']->body['und'][0]['summary'], 0, 100);
                        else 
                            print trim(substr($item->field_top_story['und'][0]['entity']->body['und'][0]['value'], 0, 100)); ?>
                        <?php  if(isset($item->field_top_story['und']  )){?>
                         <?php 
                            $author = '';
                            if(isset($item->field_top_story['und'][0]['entity']->field_add_author)) 
                            {
                                $authorArray = $item->field_top_story['und'][0]['entity']->field_add_author;
                                for($i = 0; $i<sizeof($authorArray); $i++)
                                {
                                    $author_id = $authorArray['und'][$i]['target_id'];
                                    $title = db_query("SELECT n.title, fdb.body_value from node n LEFT JOIN field_data_body fdb ON n.nid = fdb.entity_id where n.nid = $author_id ");
                                    $url = db_query("SELECT ua.alias from url_alias ua where ua.source = 'node/$author_id' ");
                                    foreach($url as $url1) $url_alias = $url1->alias;
                                    foreach($title as $title1)
                                    { 
                                        if($title1->body_value == NULL) $author.= $title1->title;
                                        else $author.= "<a href='$base_url?q=$url_alias'>".$title1->title."</a>";
                                    }
                                }
                            }
                           // else $author =  $item->field_top_story['und'][0]['entity']->field_author['und'][0]['value'] ;
                            if($author)?>  <span>By <?php echo rtrim($author, ", ") ;?></span><?php
                         }?>
                    </p>
 
                    <a href="?q=<?php echo drupal_get_path_alias('node/'.$item->field_top_story['und'][0]['entity']->nid)?>&t=1" class="readmore">Read more</a>
                </figcaption> <?php break; }?>
            </div>
         </div>
         <div class="features-list">
             <h2>Features</h2>
             <ul class="story-list clearfix">

<?php 
            foreach($formtype as $itemid) {  
                $item = field_collection_field_get_entity($itemid);  
if(isset($item->field_featured_news['und'][0])){?>
                 <li>
                     <div class="list-story clearfix">
                         <figure> 
<?php if(isset($item->field_featured_news['und'][0]['entity']->field_thumbnail['und'][0]['filename'])){?>
<img src="<?php echo $base_url.'/sites/default/files/'.$item->field_featured_news['und'][0]['entity']->field_thumbnail['und'][0]['filename'];?>" width="83" height="83"/><?php }?> </figure>
                         <figcaption>
                            <h6><?php echo $item->field_featured_news['und'][0]['entity']->title; ?></h6>
                            <p> <?php
                       
if(isset($item->field_featured_news['und'][0]['entity']->field_sub_title['und'][0]['value'])) print trim($item->field_featured_news['und'][0]['entity']->field_sub_title['und'][0]['value']); 
else if($item->field_featured_news['und'][0]['entity']->body['und'][0]['summary']) 
                            print substr($item->field_featured_news['und'][0]['entity']->body['und'][0]['summary'], 0, 100);
                        else 
                            print trim(substr($item->field_featured_news['und'][0]['entity']->body['und'][0]['value'], 0, 100));
 
 if(isset($item->field_featured_news['und']  )){?>
                                       <?php 
                                        $author = '';
//print_r($item->field_featured_news['und'][0]['entity']->field_add_author);
                                        if(!empty($item->field_featured_news['und'][0]['entity']->field_add_author)) 
                                        {
                                             $authorArray = $item->field_featured_news['und'][0]['entity']->field_add_author;
 
                                             for($i = 0; $i<sizeof($authorArray['und']); $i++)
                                             {
                                                 $author_id = $authorArray['und'][$i]['target_id'];
                                                 $title = db_query("SELECT n.title, fdb.body_value from node n LEFT JOIN field_data_body fdb ON n.nid = fdb.entity_id where n.nid = $author_id ");
                                                 $url = db_query("SELECT ua.alias from url_alias ua where ua.source = 'node/$author_id' ");
                                                 foreach($url as $url1) $url_alias = $url1->alias;
                                                 foreach($title as $title1)
                                                 {  
                                                    if(strip_tags($title1->body_value) == "" ) $author.=  $title1->title.", ";
                                                   else $author.= "<a href='$base_url?q=$url_alias'>".$title1->title."</a>".", " ; 
                                                 } 
                                              }
                                       }
                                       //else { $author .=  $item->field_featured_news['und'][0]['entity']->field_author['und'][0]['value'] ;}
                                     if($author){?>  <span>By <?php echo rtrim($author, ", ") ;?></span><?php }
                                  } ?></p>
                                     <a href="?q=<?php echo drupal_get_path_alias('node/'.$item->field_featured_news['und'][0]['entity']->nid)?>" class="readmore">Read more</a>
                                    </figcaption>
                                </div>
                                </li>
                                 <?php }}?>
                            </ul>
                            </div>
                        </div>
                        
                        <div class="widget-departments">
                            <h2>Departments</h2>
                                <ul class="clearfix">
                                    <li>
                                        <?php $insightUrl = getInsight();?>
                                        <a href="?q=<?php echo $insightUrl?>">
                                            <span id="ic-insight" class="icon">
                                                <img src="<?php echo $imagePath; ?>/images/ic-insight.png" alt="Insight"/>
                                            </span>
                                            Insight
                                        </a>
                                    </li>
                                    <li>
                                        <a href="?q=news-lists">
                                            <span id="ic-insight" class="icon">
                                                 <img src="<?php echo $imagePath; ?>/images/ic-news.png" alt="News"/>
                                            </span>
                                            News
                                        </a>
                                    </li>
                                    <li>
                                        <a href="?q=markets-lists">
                                            <span id="ic-insight" class="icon">
                                                 <img src="<?php echo $imagePath; ?>/images/ic-markets.png" alt="markets"/>
                                            </span>
                                            @Markets
                                        </a>
                                    </li>
                                    <li>
                                        <a href="?q=content/charts">
                                            <span id="ic-insight" class="icon">
                                                 <img src="<?php echo $imagePath; ?>/images/ic-data.png" alt="data"/>
                                            </span>
                                            Data
                                        </a>
                                    </li>
                                    <li>
                                        <a href="?q=content/gallery">
                                            <span id="ic-insight" class="icon">
                                                <img src="<?php echo $imagePath; ?>/images/ic-gallery.png" alt="Gallery"/>
                                            </span>
                                            Gallery
                                        </a>
                                    </li>
                                    <li>
                                        <a href="?q=people-lists">
                                            <span id="ic-insight" class="icon">
                                                <img src="<?php echo $imagePath; ?>/images/ic-people.png" alt="people"/>
                                            </span>
                                            People
                                        </a>
                                    </li>
                                    <li>
					<?php $givingUrl = getGiving();?>
                                        <a href="?q=<?php echo $givingUrl ?>">
                                            <span id="ic-insight" class="icon">
                                                 <img src="<?php echo $imagePath; ?>/images/ic-giving.png" alt="Giving"/>
                                            </span>
                                            Giving
                                        </a>
                                    </li>
                                </ul>
                        </div>
