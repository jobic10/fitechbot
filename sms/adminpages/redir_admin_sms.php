    <?php
    require_once '../../Classes/sessionBasics.php';
    $sessionB =new sessionBasics();
    if (!isset($_SESSION["role"])) 
    {       
    session_destroy();
    header("location:../../admin/index.php");
    exit();
    }
    else
    {
    $role=$_SESSION["role"];
    }
    ?>