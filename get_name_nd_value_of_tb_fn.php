<?php
$aa=array();  
function get_col_name_tb_fn($tb_name,$con) 
{ 
$ColumnNames=mysql_query("SHOW COLUMNS FROM $tb_name") or die("Column names Could not be listed");
while($each_col_name=mysql_fetch_array($ColumnNames,MYSQL_NUM) )
{
$colm_names_in_arr[]= $each_col_name[0];
}
return  $colm_names_in_arr;
}

function get_value_tb_col_fn($tb_name,$con,$arr_field_to_match)
{
$result = mysql_query("SELECT * FROM `$tb_name`");
$no_of_fields= mysql_num_fields($result);
$row_num=1;
while($row = mysql_fetch_array($result,MYSQL_ASSOC))
  {
    $i=0;
    foreach ($row as $col_value)
    {   
        $name_of_field=  mysql_field_name($result, $i);
        $aa[$name_of_field]=$col_value;
        if($i % $no_of_fields==0)
        { 
        echo "<br/><font color='red'> Row $row_num  </font> ";
        }  else
        { 
        echo " <font color='green'>| $name_of_field: $col_value </font> ";
        }
        $i++;
     }
echo " |";
$row_num++;
  }
//mysql_free_result($result);
}

require "secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];
$db_name=$return_con[2];
$tb_name="students";
//$result = mysql_query("SELECT * FROM `$tb_name`");
//print_r(mysql_field_array($result ));
//get_value_tb_col_fn($tb_name,$con,null);
print_r(get_col_name_tb_fn($tb_name,$con));
