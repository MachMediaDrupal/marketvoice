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
  <?php endif; 

?>
<div class="widget-author">
     <h5>About the Author</h5>
       <h3> <?php print $title;?> </h3>
       <div  class="widget-author-details clearfix">
           <div class="author-descpin"><?php 
               print render($content['body']);?>





               <div class="clearfix"><?php 
$query = db_query("SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_add_author` fda
JOIN node n ON n.nid = fda.field_add_author_target_id
JOIN field_data_field_featured_news fdf ON fdf.field_featured_news_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16 AND n.nid = $node->nid

UNION 

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_add_author` fda
JOIN node n ON n.nid = fda.field_add_author_target_id
JOIN field_data_field_top_story fdf ON fdf.field_top_story_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $node->nid

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_add_author` fda
JOIN node n ON n.nid = fda.field_add_author_target_id
JOIN field_data_field_news fdf ON fdf.field_news_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $node->nid

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_markets_add_author` fda
JOIN node n ON n.nid = fda.field_markets_add_author_target_id
JOIN field_data_field_markets fdf ON fdf.field_markets_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $node->nid

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_people_add_author` fda
JOIN node n ON n.nid = fda.field_people_add_author_target_id
JOIN field_data_field_people fdf ON fdf.field_people_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $node->nid

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_insight_add_author` fda
JOIN node n ON n.nid = fda.field_insight_add_author_target_id
JOIN field_data_field_insight fdf ON fdf.field_insight_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $node->nid

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_giving_add_author` fda
JOIN node n ON n.nid = fda.field_giving_add_author_target_id
JOIN field_data_field_giving fdf ON fdf.field_giving_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $node->nid

 ");

                   $leftli = ''; $rightli = "";
                   $i = 0;
                    foreach ($query as $res)
                    {

                       $target_id = $res->nid;
                       $result = db_query("Select ua.alias FROM  url_alias ua where ua.source = 'node/$target_id'");
                       foreach ($result as $row)
                          $url = $row->alias; 
                       $title = $res->articleTitle;
                       if($i%2 == 0)
                           $leftli .= "<li><a href='$base_url?q=/$url' target='_blank'> $title </a></li>" ;
                       else $rightli .= "<li><a href='$base_url?q=/$url' target='_blank'>$title</a></li>" ;   
                       $i++;
                     }

                  /* $field_name = 'field_related_news';
                   $field= field_get_items('node', $node, $field_name); 
                  
                   if(sizeof($field)>0) {  
                   for($i = 0; $i<sizeof($field); $i++)
                   {
                       $target_id = $field[$i]['target_id'];
                       $result = db_query("Select ua.alias FROM  url_alias ua where ua.source = 'node/$target_id'");
                       foreach ($result as $row)
                          $url = $row->alias; 
                       $title = $field[$i]['entity']->title;
                       if($i %2 == 0)
                           $leftli .= "<li><a href='$base_url?q=/$url' target='_blank'> $title </a></li>" ;
                       else $rightli .= "<li><a href='$base_url?q=/$url' target='_blank'>$title</a></li>" ;     
                   }
              }*/ ?>
               <ul  class="widget-article"><?php echo $leftli?> </ul>
               <ul  class="widget-article"><?php echo $rightli?> </ul>                                         
          </div>
     </div>
 </div>
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
