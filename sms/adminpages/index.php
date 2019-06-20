    <?php 
    require_once '../Classes/sessionBasics.php';
    $sessionB =new sessionBasics();
    if (!isset($_SESSION["role"])) 
    {       
    session_destroy();
    header("location:../../index.php");
    }
    else
    {
    header("location:admin.php");
    }