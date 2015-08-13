<?php  
function getInsight()
{
    $site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }
    
    $query =  " SELECT ua.alias FROM (SELECT n.nid FROM field_data_field_insight dfi INNER JOIN field_data_field_news_in_this_issue dis ON dfi.entity_id = dis.field_news_in_this_issue_value INNER JOIN node n ON n.nid = dfi.field_insight_target_id WHERE dis.entity_id = $front_node) a, url_alias ua WHERE ua.source = CONCAT('node/',  a.nid) ";
    $result =  db_query($query);

    foreach ($result as $row)
        $url = $row->alias;

    return $url;
}

function getGiving()
{
    $site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }
    
    $query =  " SELECT ua.alias FROM (SELECT n.nid FROM field_data_field_giving dfi INNER JOIN field_data_field_news_in_this_issue dis ON dfi.entity_id = dis.field_news_in_this_issue_value INNER JOIN node n ON n.nid = dfi.field_giving_target_id WHERE dis.entity_id = $front_node) a, url_alias ua WHERE ua.source = CONCAT('node/',  a.nid) ";
    $result =  db_query($query);

    foreach ($result as $row)
        $url = $row->alias;

    return $url;
}
?>
