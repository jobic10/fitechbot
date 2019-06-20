<?php
/**
 * Description of Portal_Class
 * This Class is for the portal grading system and for the School Management System as a whole
 * @author Ayologbon
 */
class Portal_Class 
{
    protected $F9=array();
    protected $E8=array();
    protected $D7=array();
    protected $C6=array();
    protected $C5=array();
    protected $C4=array();
    protected $B3=array();
    protected $B2=array();
    protected $A1=array();
    protected $P=array();
    protected $C=array();
    protected $remarks_snr=array();
    protected $grades_snr=array();
    protected $remarks_jnr=array();
    protected $grades_jnr=array();
    protected $class_arms_alpha=array();
    protected $in_scores;
    protected $in_grades_or_remarks;
    protected $j_nd_s_class=array("JSS 1","JSS 2","JSS 3","SSS 1","SSS 2","SSS 3");
    protected $qtn_options=array();
    protected $keys_rg_snr=array("F9","E8","D7","C6","C5","C4","B3","B2","A1");
    protected $keys_rg_jnr=array("F9","P","C","A1");
    /*
    protected $remarks_snr_val=array("FAIL" ,"WEAK PASS", "PASS", "CREDIT", "CREDIT", "CREDIT", "GOOD", "VERY GOOD", "EXCELLENT");
    protected $grades_snr_val=array("F<sub>9</sub>" ,"E<sub>8</sub>", "D<sub>7</sub>", "C<sub>6</sub>", "C<sub>5</sub>", "C<sub>4</sub>", "B<sub>3</sub>", "B<sub>2</sub>", "A<sub>1</sub>");
    protected $remarks_jnr_val=array("FAIL" ,"PASS", "CREDIT","EXCELLENT");
    protected $grades_jnr_val=array("F<sub>9</sub>" ,"P", "C","A<sub>1</sub>");
    */
    
     public function __construct()
     {
         ini_set("auto_detect_line_endings",true);
         require_once "functions/get_site_domain_url.php";
         $server_name=$_SERVER["SERVER_NAME"]; 
         $site_domain_files=get_site_domain_url($server_name,"Classes/files"); 
         $grades_snr_val=file("$site_domain_files"."grades_snr_val.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
         $grades_jnr_val=file("$site_domain_files"."grades_jnr_val.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
         $remarks_snr_val=file("$site_domain_files"."remarks_snr_val.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
         $remarks_jnr_val=file("$site_domain_files"."remarks_jnr_val.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
         $this->F9=  range(0, 39);
         $this->E8=  range(40, 44);
         $this->D7=  range(45, 49);
         $this->C6=  range(50, 54);
         $this->C5=  range(55,59);
         $this->C4=  range(60, 64);
         $this->B3=  range(65, 69);
         $this->B2=  range(70, 74);
         $this->A1=  range(75, 100);
         $this->P=   range(40, 49);
         $this->C=   range(50, 74);
         $this->class_arms_alpha=range("A", "J");
         $this->qtn_options=range("A","E");
         $this->grades_snr =array_combine($this->keys_rg_snr,  $grades_snr_val);
         $this->remarks_snr=array_combine($this->keys_rg_snr,  $remarks_snr_val);
         $this->grades_jnr =array_combine($this->keys_rg_jnr,  $grades_jnr_val);
         $this->remarks_jnr=array_combine($this->keys_rg_jnr,  $remarks_jnr_val);
     }
     
    public function getClassArms()
    {
    return $this->class_arms_alpha;
    }
    public function getClassList()
    {
    return $this->j_nd_s_class;
    }
    
    private  function getRemarksAndGradesJnr($in_scores,$in_grades_or_remarks) 
    {
    if($in_grades_or_remarks=="GRADE")
    {
    $remark=$this->grades_jnr;  
    }
    elseif ($in_grades_or_remarks=="REMARK") 
    {
    $remark=$this->remarks_jnr; 
    }
    else 
    {
    $remark="Parameters Not recognized"; 
    exit();
    }
    
    foreach ($remark as  $key=> $remark_val) 
    { 
    if(in_array($in_scores, $this->$key))
    {
    return $remark_val; 
    }
    }
    }
    
    private function getRemarksAndGradesSnr($in_scores,$in_grades_or_remarks) 
    { 
        
    if($in_grades_or_remarks=="GRADE")
    {
    $remark=$this->grades_snr;  
    }
    elseif ($in_grades_or_remarks=="REMARK") 
    {
    $remark=$this->remarks_snr; 
    }
    else 
    {
    $remark="Parameters Not recognized"; 
    exit();
    }
    foreach ($remark as  $key=> $remark_val) 
    { 
    if(in_array($in_scores, $this->$key))
    {
    return $remark_val; 
    }
    }
          
    }
    
        
    public function getRemarksAndGrades($class_type,$in_scores,$in_grades=null)
    {
    if(strpos($class_type,"JSS")!==false)
    {
    return $this-> getRemarksAndGradesJnr($in_scores,$in_grades);     
    }
    else      
    {
    return $this-> getRemarksAndGradesSnr($in_scores,$in_grades);    
    } 
    }
   

}
