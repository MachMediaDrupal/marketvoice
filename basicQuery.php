<?php
/* Functions to execute raw query for charts*/

/*
* Function to get the reported year in charts
*
*/
function getReportYear()
{
    $query = "SELECT DISTINCT(field_reportyear_value) FROM field_data_field_reportyear  ORDER BY field_reportyear_value desc";
    return db_query($query);
}

/*
* Function to get the total Volume Query
*
*/
function totalVolumeQuery($data)
{

    $range =  range($data['startMonth'], $data['endMonth']);
    $range = implode(",", $range);

    $totalVolumequery = "SELECT GROUP_CONCAT(a.fieldamt) as amt, a. field_instrumenttype_value  FROM 
        (SELECT SUM(fs.field_sumofvolume_value) as fieldamt, fi.field_instrumenttype_value, 
        fy.field_reportyear_value  from  field_data_field_sumofvolume fs
        JOIN field_data_field_instrumenttype fi ON fs.entity_id = fi.entity_id 
        JOIN field_data_field_reportyear fy ON fy.entity_id = fi.entity_id 
        JOIN field_data_field_reportmonth fm ON fm.entity_id = fi.entity_id 
        WHERE fm.field_reportmonth_value IN ($range) 
        GROUP BY fi.field_instrumenttype_value, fy.field_reportyear_value, 
        fy.field_reportyear_value ORDER BY fy.field_reportyear_value desc) a 
        GROUP BY a. field_instrumenttype_value";
       
    return db_query($totalVolumequery);
}


function getByCategory($data)
{
    $range =  range($data['startMonth'], $data['endMonth']);
    $range = implode(",", $range);
 
    $byCategory = "SELECT  GROUP_CONCAT(a.fieldamt) as amt, a. field_instrumentgroupname_value  FROM 
        ( SELECT SUM(fs.field_sumofvolume_value) as fieldamt, fi.field_instrumentgroupname_value, 
        fy.field_reportyear_value  from  field_data_field_sumofvolume fs
        JOIN field_revision_field_instrumentgroupname fi ON fs.entity_id = fi.entity_id 
        JOIN field_data_field_reportyear fy ON fy.entity_id = fi.entity_id  
        JOIN field_data_field_reportmonth fm ON fm.entity_id = fi.entity_id 
        WHERE fm.field_reportmonth_value IN ($range) 
        GROUP BY fi.field_instrumentgroupname_value, fy.field_reportyear_value, 
        fy.field_reportyear_value ORDER BY fy.field_reportyear_value desc, fieldamt DESC ) a 
        GROUP BY a. field_instrumentgroupname_value ORDER BY a.field_reportyear_value desc, a.fieldamt DESC";

     return db_query($byCategory);
}

function getTopTwenty($data) 
{
    $range =  range($data['startMonth'], $data['endMonth']);
    $range = implode(",", $range);

$latestTopTwenty = "SELECT SUM( fs.field_sumofvolume_value ) AS fieldamt, fe.field_exchangename_value, fy.field_reportyear_value
FROM field_data_field_sumofvolume fs
JOIN field_data_field_exchangename fe ON fs.entity_id = fe.entity_id
JOIN field_data_field_reportyear fy ON fy.entity_id = fe.entity_id
JOIN field_data_field_reportmonth fm ON fm.entity_id = fe.entity_id WHERE fm.field_reportmonth_value IN ($range)
GROUP BY  fe.field_exchangename_value, fy.field_reportyear_value 
ORDER BY fy.field_reportyear_value DESC,   fieldamt DESC LIMIT 0,20";

$twentyResult = db_query($latestTopTwenty);

foreach ($twentyResult as $row) {
$exchange[] = "'".$row->field_exchangename_value."'";
$year[] = $row->field_reportyear_value;
$result[] = $row;
}
$exchange = implode(",", $exchange);
$year = implode(",", $year);


$latestTopTwenty1 = "SELECT SUM( fs.field_sumofvolume_value ) AS fieldamt, fe.field_exchangename_value, fy.field_reportyear_value
FROM field_data_field_sumofvolume fs
JOIN field_data_field_exchangename fe ON fs.entity_id = fe.entity_id
JOIN field_data_field_reportyear fy ON fy.entity_id = fe.entity_id
JOIN field_data_field_reportmonth fm ON fm.entity_id = fe.entity_id WHERE fm.field_reportmonth_value IN ($range) AND fe.field_exchangename_value IN ($exchange) AND fy.field_reportyear_value NOT IN ($year)
GROUP BY  fe.field_exchangename_value, fy.field_reportyear_value 
ORDER BY fy.field_reportyear_value DESC,   fieldamt DESC LIMIT 0,20";
$twentyResult1 = db_query($latestTopTwenty1);

foreach ($twentyResult1 as $row) {
$result1 [] = $row;

}


$workFirstArray = array_combine(
    array_map(function($object) { return $object->field_exchangename_value;}, $result), $result
);
$workSecondArray = array_combine(
    array_map(function($object) { return $object->field_exchangename_value;}, $result1), $result1
);

//map merged elements back to StdClass
$result2 = array_map(function($element) {
        if(is_array($element)) {
            $element['field_exchangename_value'] = end($element['field_exchangename_value']);
            $element=(object)$element;
        }
        return $element;
    },
    array_merge_recursive($workFirstArray, $workSecondArray)
);


return $result2;
}

function galleryImageLoad()
{
    /* $imageQuery = "SELECT fm.filename, fgi.entity_id, fdb.body_value FROM field_data_field_gallery_image fgi JOIN file_managed fm ON fgi.field_gallery_image_fid = fm.fid 
JOIN field_data_body fdb ON fdb.entity_id = fgi.entity_id ORDER BY fgi.entity_id DESC";*/

$site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }

 $imageQuery = "SELECT fm.filename, n.nid, n.title, dis.entity_id, dfg.entity_id, fdb.body_value FROM field_data_field_gallery dfg INNER JOIN field_data_field_news_in_this_issue dis ON dfg.entity_id = dis.field_news_in_this_issue_value  AND dis.entity_id = $front_node
INNER JOIN node n ON n.nid = dfg.field_gallery_target_id
INNER JOIN field_data_field_gallery_image dfi ON dfi.entity_id  = n.nid
INNER JOIN file_managed fm ON dfi.field_gallery_image_fid = fm.fid 
INNER JOIN field_data_body fdb ON fdb.entity_id = dfi.entity_id 
LEFT JOIN field_data_field_gallery_order fgo ON fgo.entity_id = n.nid
ORDER BY fgo.field_gallery_order_value ASC";

    return db_query($imageQuery);
}
function galleryImageThumbnailLoad()
{
$site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }
/*$thumbnailImage = "SELECT fm.filename, fgt.entity_id FROM field_data_field_gallery_thumbnail fgt JOIN file_managed fm ON fgt.field_gallery_thumbnail_fid = fm.fid  ORDER BY fgt.entity_id DESC";
*/

$thumbnailImage = "SELECT fm.filename, n.nid,dis.entity_id, dfg.entity_id, fdb.body_value FROM field_data_field_gallery dfg INNER JOIN field_data_field_news_in_this_issue dis ON dfg.entity_id = dis.field_news_in_this_issue_value  AND dis.entity_id = $front_node
INNER JOIN node n ON n.nid = dfg.field_gallery_target_id
INNER JOIN field_data_field_gallery_thumbnail dfi ON dfi.entity_id  = n.nid
INNER JOIN file_managed fm ON dfi.field_gallery_thumbnail_fid = fm.fid 
INNER JOIN field_data_body fdb ON fdb.entity_id = dfi.entity_id 
LEFT JOIN field_data_field_gallery_order fgo ON fgo.entity_id = n.nid
ORDER BY fgo.field_gallery_order_value ASC";
return db_query($thumbnailImage);

}



function galleryChartsLoad()
{

$site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }

 $imageQuery = "SELECT fm.filename as original, n.nid,dis.entity_id, dfg.entity_id, fdb.body_value, fdn.field_notes_value, fcs.field_charts_subtitle_value, fzm.filename as zoom,  fd.field_download_value  FROM field_data_field_charts dfg INNER JOIN field_data_field_news_in_this_issue dis ON dfg.entity_id = dis.field_news_in_this_issue_value  AND dis.entity_id = $front_node
INNER JOIN node n ON n.nid = dfg.field_charts_target_id
INNER JOIN field_data_field_charts_image dfi ON dfi.entity_id  = n.nid
INNER JOIN file_managed fm ON dfi.field_charts_image_fid = fm.fid 
INNER JOIN field_data_body fdb ON fdb.entity_id = dfi.entity_id
LEFT JOIN field_data_field_notes fdn ON fdn.entity_id = dfi.entity_id
LEFT JOIN field_data_field_charts_subtitle fcs ON fcs.entity_id = dfi.entity_id
LEFT JOIN field_data_field_chart_order fco ON fco.entity_id = n.nid

LEFT JOIN field_data_field_zoom_image fzi ON fzi.entity_id = dfi.entity_id
LEFT JOIN file_managed fzm ON fzi.field_zoom_image_fid = fzm.fid 
LEFT JOIN field_data_field_download fd ON fd.entity_id = dfi.entity_id

 ORDER BY fco.field_chart_order_value ASC";


    /* $imageQuery = "SELECT fm.filename, fgi.entity_id, fdb.body_value FROM field_data_field_charts_image fgi JOIN file_managed fm ON fgi.field_charts_image_fid = fm.fid 
LEFT JOIN field_data_body fdb ON fdb.entity_id = fgi.entity_id ORDER BY fgi.entity_id DESC";*/

    return db_query($imageQuery);
}
function galleryChartsThumbnailLoad()
{

$site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }


$thumbnailImage = "SELECT fm.filename, n.nid,dis.entity_id, dfg.entity_id, fdb.body_value FROM field_data_field_charts dfg INNER JOIN field_data_field_news_in_this_issue dis ON dfg.entity_id = dis.field_news_in_this_issue_value  AND dis.entity_id = $front_node
INNER JOIN node n ON n.nid = dfg.field_charts_target_id
INNER JOIN field_data_field_charts_thumbnail dfi ON dfi.entity_id  = n.nid
INNER JOIN file_managed fm ON dfi.field_charts_thumbnail_fid = fm.fid 
INNER JOIN field_data_body fdb ON fdb.entity_id = dfi.entity_id  
LEFT JOIN field_data_field_chart_order fco ON fco.entity_id = n.nid ORDER BY fco.field_chart_order_value ASC";

/*
$thumbnailImage = "SELECT fm.filename, fgt.entity_id FROM field_data_field_charts_thumbnail fgt JOIN file_managed fm ON fgt.field_charts_thumbnail_fid = fm.fid  ORDER BY fgt.entity_id DESC";
*/
return db_query($thumbnailImage);



}

function galleryHeadLoad()
{
    $site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }

 $imageQuery = "SELECT n.title, fdb.body_value  FROM field_data_field_gallery_details dfg INNER JOIN field_data_field_news_in_this_issue dis ON dfg.entity_id = dis.field_news_in_this_issue_value  AND dis.entity_id = $front_node
INNER JOIN node n ON n.nid = dfg.field_gallery_details_target_id
LEFT JOIN field_data_body fdb ON fdb.entity_id = n.nid";

    return db_query($imageQuery);
}


function chartsNotesLoad()
{
    $site_frontpage = variable_get('site_frontpage', 'node');
    list($first, $second) = explode('/', $site_frontpage, 2);
    if ($first == 'node' && is_numeric($second)) {
        $front_node = $second;
    } else {
      // It's not a node page.
    }

 $imageQuery = "SELECT n.title, fdb.body_value  FROM field_data_field_common_chart_notes dcn INNER JOIN field_data_field_news_in_this_issue dis ON dcn.entity_id = dis.field_news_in_this_issue_value  AND dis.entity_id = $front_node
INNER JOIN node n ON n.nid = dcn.field_common_chart_notes_target_id
LEFT JOIN field_data_body fdb ON fdb.entity_id = n.nid";

    return db_query($imageQuery);
}



?>

