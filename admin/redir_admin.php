    <?php
    require_once '../Classes/sessionBasics.php';
    $sessionB =new sessionBasics();
    if (!isset($_SESSION["role"]))                                 
    {
    header("location:index.php");
    exit();
    }
    else
    {
    $role=$_SESSION["role"];
    }
    ?>