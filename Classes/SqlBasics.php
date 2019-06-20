<?php
/**
 * Description of SqlBasics
 *
 * @author Prophet TbJoshua
 */
class SqlBasics 
{ 
    public $rand_key;
    var $con;
    var $connPDO;
    protected $db_name;
    protected $dbreturnval=array();
    
    public function   SqlBasics($dbname="cms") //__construct()
    {
    $rk=md5(uniqid(rand(),TRUE));
    $this->rand_key=Substr($rk,0,15);
    $this->db_connection($dbname);
    }
    
   private function db_connection($incomming_db_name)
{
    $return_con=array();
    $host_server= shell_exec('hostname');
    $host_server=trim($host_server);
    $host_server=strtolower($host_server);
    //$site_domain=$_SERVER["SERVER_NAME"];
    $site_domain=filter_input(INPUT_SERVER,'SERVER_NAME',FILTER_SANITIZE_STRING);
    $site_domain=trim($site_domain);
    $site_domain=strtolower($site_domain);
    $return_site_domain=$site_domain;
    if (strpos($site_domain,"www.")!==false)
    {
    $site_domain=str_replace("www.","",$site_domain);
    if (strpos($site_domain,".")!==false)
    {
    $site_domain=str_replace(".","",$site_domain);
    }
    }
    else 
    {
    $site_domain="localhost";   
    }
    $site_domain=substr($site_domain,0,8);
    /*
    if($site_domain=="16925415" || $site_domain=="localhos" || $site_domain=="19216817" || $site_domain=="19216843" || $site_domain=="19216813" || $site_domain=="127001"  || $site_domain=="16925412")
    {
    $site_domain="localhos"; 
    }
     */
    $site_domain=$site_domain."_";
    $user=$site_domain."fitech";
    $db_password="^%_&Fg_2";
    $mysql_host = 'localhost';
    /*
    $con = mysqli_connect($mysql_host , $user, $db_password);
    if (!$con)
    {
    die('Could not connect: ' . mysqli_connect_error());
    }
    */ 
    $con = new mysqli($mysql_host, $user, $db_password);
    if ($con->connect_error) 
    {
    die("Connection failed: " . $con->connect_error);
    }
    else 
    {
    $this->con=$con;  
    }
    $db_name=$site_domain."$incomming_db_name";
    $this->db_name=$db_name;
    $sql = "CREATE DATABASE IF NOT EXISTS $db_name";  //mysqli_query($con,"CREATE DATABASE IF NOT EXISTS $db_name");
    //$this->crtTbsOr($sql);
    if (!$con->query($sql)) 
    {
    die("Error creating database: " . $con->error);
    }
    if(!$con->select_db($db_name))//mysqli_select_db($con,"$db_name") or die("cannot select database:".  mysqli_error());
    {
    die("cannot select database:".  $con->error); 
    }
    $this->dbConnPDO($db_name,$mysql_host , $user, $db_password);
}
    private function dbConnPDO($dbname,$servername , $user, $db_password)
    {
    try 
    {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->connPDO=$conn;
    }
    catch(PDOException $e)
    {
    die( "Connection failed: " . $e->getMessage());
    }
    }

    private function crtTbsOr($sql) 
    {
    $conn=$this->con;
    if (!$Kingsley=$conn->query($sql)) 
    {
    return $this->crtTbsPDO($sql);//die("Error: " . $conn->error.$sql);
    } 
    else 
    {
    return $Kingsley;
    }
    //$conn->close();
    }

    
    private function crtTbsPDO($sql) 
    {
    $conn=$this->connPDO;
    try 
    {
    $smt=$conn->prepare($sql);
    return $smt->execute(); //exec(); shell_exec($cmd)//return $Kingsley= $conn->exec($sql);
    }
    catch(PDOException $e)
    {
    die( $sql . "<br>" . $e->getMessage());
    }
    //$conn = null;
    }
    
    public function num_Rows($result) 
    {
    return $result->num_rows; //mysqli_num_rows($result);
    }
    private function fetchOnce($result) 
    {
    return $row = $result->fetch_assoc();
    }
    private function fetchAll($result) 
    {
    return $row = $result->fetch_array();  ////return $row = mysqli_fetch_assoc($result);
    }
    public function importDb($sql) 
    {
    $templine = '';
    if(is_file($sql))
    {
    $lines = file($sql);
    }
    else 
    {
    $lines=  explode("\n", $sql); 
    }
    foreach ($lines as $line)
    {
    if (substr($line, 0, 2) == '--' || $line == '')
    continue;
    $templine .= $line;
    if (substr(trim($line), -1, 1) == ';')
    {
    $this->tmp_create_tb($templine);
    //mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    $templine = '';
    }
    }
    }

    public function exportDb($bckupDir='',$tables = '*')
    {
    $this->tmp_create_tb("SET NAMES 'utf8'");
    if($tables == '*')
    {
    $tables = array();
    $result =  $this->tmp_create_tb('SHOW TABLES');
    while($row = $result->fetch_row())
    {
    $tables[] = $row[0];
    }
    }
    else
    {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
    }
    
    $return='';
    foreach($tables as $table)
    {
    $result = $this->tmp_create_tb("SELECT * FROM `$table` ");
    $num_fields=$result->field_count;
    //$return.= 'DROP TABLE '.$table.';';$ddd=$result->fetch_row();print_r($ddd[1]);exit;
    $shtb=$this->tmp_create_tb("SHOW CREATE TABLE `$table`");
    $row2 =$shtb->fetch_row();
    $return.= "\n\n".$row2[1].";\n\n";
    for ($i = 0; $i < $num_fields; $i++) 
    {
    while($row =$result->fetch_row())
    {
    $return.= "INSERT INTO `$table` VALUES(";
    for($j=0; $j<$num_fields; $j++) 
    {
    $row[$j] = addslashes($row[$j]);
    $row[$j] = str_replace("\n","\\n",$row[$j]);
    if (isset($row[$j])) { $return.= "'$row[$j]'" ; } else { $return.= "''"; }
    if ($j<($num_fields-1)) { $return.= ","; }
    }
    $return.= ");\n";
    }
    }
    $return.="\n\n\n";
    }
    $final_filename=$bckupDir.$this->db_name.".sql";
    $handle = fopen($final_filename,'w+');
    fwrite($handle,$return);
    fclose($handle);
    return $final_filename;
    }


    public function tmp_create_tb($in_qry)
    {
    if(is_file($in_qry))
    {
    $sql=file_get_contents($in_qry);
    return $this->crtTbsOr($sql);
    }
    else   
    {
    $sql=$in_qry;   
    }
    if (!$Kingsley=mysqli_query($this->con,$sql))
    { 
    die("Error: ".mysqli_error($this->con).$sql);
    } 
    return $Kingsley;
    }
    
    public function getColName($tb_name) 
    { 
    $colm_names_in_arr=array();
    $ColumnNames=$this->tmp_create_tb("SHOW COLUMNS FROM $tb_name");
    while($each_col_name=mysqli_fetch_array($ColumnNames,MYSQL_NUM) )
    {
    $colm_names_in_arr[]= $each_col_name[0];
    }
    return  $colm_names_in_arr;
    }
    
    public function altTbDropCol($tbname,$fn)
    {
    $sql="SHOW columns from `$tbname` where field='$fn'";
    $sql2="alter table `$tbname` DROP `$fn`";
    if ($this->tmp_create_tb($sql)->num_rows >0)
    { 
    $this->tmp_create_tb($sql2);
    }   
    }
    
    public function altTbAddCol($tbname,$fn,$dtp)
    {
    $sql="SHOW columns from `$tbname` where field='$fn'";
    $sql2="alter table `$tbname` ADD `$fn` $dtp";  //ALTER TABLE $tbname ALTER COLUMN $fn $dtp
    $this->tmp_create_tb($sql)->num_rows;
    //$r=$this->tmp_create_tb($sql)->num_rows;   //mysqli_num_rows($this->tmp_create_tb($sql));
    if ($this->tmp_create_tb($sql)->num_rows==0)
    { 
    $this->tmp_create_tb($sql2);
    }   
    }
    
    public function send_mail($rc_mail,$mail_subject,$mail_content)
    {
    date_default_timezone_set('Africa/Lagos');
    $date=date('l: Y-m-d ');
    $time=date('h:i:s A');
    $mail_subject=$mail_subject."\r\n"."On: $date @: $time ";
    $mail_content=$mail_content."\r\n"."On: $date @: $time ";
    $mail_headers="From:FITECHBOT"."\r\n"."cc:FITECHBOT";
    mail($rc_mail,$mail_subject,$mail_content,$mail_headers);    
    }
   
    public function genInsertSqlPattern($tbname,$colnames=null)
    {
    if($colnames==NULL)
    {
    $colnames=$this->getColName($tbname);  
    unset($colnames[0]);  
    }
    $sql = "INSERT INTO `$tbname` (".
    $sql2="";
    $index=1;
    $cm=","; 
    foreach ($colnames as $value)
    {
    if($index!==1)
    {
    $sql.=$cm;
    $sql2.=$cm;
    }
    $sql.="`$value`";
    $sql2.="'[$value]'";
    $index++;
    }
    $sql.=") VALUES";
    $tmpatt="($sql2)";
    $sql.=$this->genInsertSqlValPatt($tmpatt);
    return $sql;
    }
    
    public function genInsertSqlValPatt($InsertQryValPatt,$lpnum=1)
    {
    $tpSql="";
    $cm=",";
    for($x=1;$x<=$lpnum;$x++)
    {
    if($x!==1)
    {
    $tpSql.=$cm;
    } 
    $tpSql.=$InsertQryValPatt;
    }
    return $tpSql;
    }

    public function no_Tables()
    {
    $sql="show tables";
    $numRows=$this->tmp_create_tb($sql)->num_rows;
    if($numRows==0) 
    {
    return TRUE;
    }
    else
    {
    return FALSE;//$numRows;
    }
    }
}
