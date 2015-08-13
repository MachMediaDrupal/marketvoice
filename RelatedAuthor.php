<?php 
function getRelatedAuthor($authorId)
{
    return db_query("SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_add_author` fda
JOIN node n ON n.nid = fda.field_add_author_target_id
JOIN field_data_field_featured_news fdf ON fdf.field_featured_news_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16 AND n.nid = $authorId

UNION 

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_add_author` fda
JOIN node n ON n.nid = fda.field_add_author_target_id
JOIN field_data_field_top_story fdf ON fdf.field_top_story_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $authorId

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_add_author` fda
JOIN node n ON n.nid = fda.field_add_author_target_id
JOIN field_data_field_news fdf ON fdf.field_news_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $authorId

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_markets_add_author` fda
JOIN node n ON n.nid = fda.field_markets_add_author_target_id
JOIN field_data_field_markets fdf ON fdf.field_markets_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $authorId

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_people_add_author` fda
JOIN node n ON n.nid = fda.field_people_add_author_target_id
JOIN field_data_field_people fdf ON fdf.field_people_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $authorId

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_insight_add_author` fda
JOIN node n ON n.nid = fda.field_insight_add_author_target_id
JOIN field_data_field_insight fdf ON fdf.field_insight_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $authorId

UNION

SELECT   n1.title as articleTitle, n1.nid, n.title
FROM  `field_data_field_giving_add_author` fda
JOIN node n ON n.nid = fda.field_giving_add_author_target_id
JOIN field_data_field_giving fdf ON fdf.field_giving_target_id= fda.entity_id   
JOIN field_data_field_news_in_this_issue dis ON fdf.entity_id   = dis.field_news_in_this_issue_value
JOIN node n1 ON n1.nid = fda.entity_id 
WHERE dis.entity_id =16  AND n.nid = $authorId

 ");
}
?>
