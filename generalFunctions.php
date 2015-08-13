<?php

/*Generic function to build table from parameters
*
*/
function buildTable($head_column, $head, $body, $field )
{ 

    $table = "<table>";
    $table.= "<th>".$head_column."</th>";
    for($i = 0; $i<sizeof($head); $i++)
    {
       $table.= "<th>".$head[$i]."</th>";
    }
    
    foreach ($body as $row) {
        $table.= "<tr>";
        $table.= "<td>". $row->$field."</td>";
        $amtArray = explode( ",", $row->amt);

        for($i=0; $i<sizeof($amtArray); $i++){ 
          $table.="<td>".number_format($amtArray[$i], 3)."</td>";
        }
    }
    $table.= "</table>";
    
    return $table;
}

function buildMonthHead($month)
{
    return date('M', mktime(0, 0, 0, $month, 10)); // March
}

function buildTopTables($head_column, $head, $body)
{
    $table = "<table>";
    $table.= "<th>Rank</th>";
    $table.= "<th>".$head_column."</th>";
    for($i = 0; $i<sizeof($head); $i++)
       $table.= "<th>".$head[$i]."</th>";
    $j = 1;
    foreach ($body as $row) {
        $table.= "<tr>";
 $table.= "<td>". $j."</td>";
        $table.= "<td>". $row->field_exchangename_value."</td>";

if(Sizeof($row->fieldamt) >1 ){
        $table.="<td>".number_format( $row->fieldamt[0], 3)."</td>";
 $table.="<td>".number_format( $row->fieldamt[1], 3)."</td>";}
else {$table.="<td>".number_format( $row->fieldamt, 3)."</td>";$table.="<td>0</td>";}
$j++;
    }
    $table.= "</table>";
    
    return $table;
}
?>
