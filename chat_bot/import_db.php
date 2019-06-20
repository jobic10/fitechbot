<?php
ini_set('max_execution_time',6000);
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("bot");
$con=$return_con[0];
$user=$return_con[1];
$db_name=$return_con[2];
$mysql_pass=$return_con[4];
$mysql_host=$return_con[5];


$filename = 'bot.sql';
$mysql_host = $mysql_host;
// MySQL password
$mysql_password = $mysql_pass;
// Connect to MySQL server
mysql_connect($mysql_host, $user, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($db_name) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 
$filename="bot.zip";
$new_finame="../bot.zip";
$filename9="bot.sql";
if(!rename($filename,$new_finame))
{

echo "<font color='red' size='10'>Soryy,File could not be moved!</font>";

}

unlink($filename9);
?>