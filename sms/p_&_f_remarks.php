<?php
function p_remarks($all,$promotion_info,$termuse)
{
if($termuse=="THIRD TERM")
{

if($promotion_info=="WITHDRAWN")
{
return "Having repeated your present class twice,you are hereby withdrawn from the school"; 
}
if($promotion_info=="TO REPEAT")
{
return "You are to repeat your present class,you better sit tight next session"; 
}
if($all>34 && $all<55 && $promotion_info=="TO RESIT")
{
return "A fairly good result,You will still have to resit the failed core subject/s though"; 
}

if($all>54 && $all<65 && $promotion_info=="TO RESIT")
{
return "A good result,You will still have to resit the failed core subject/s though"; 
}
 

if($all>=64 && $all<101 && $promotion_info=="TO RESIT")
{
return "An excellent result,You will still have to resit the failed core subject/s though"; 
}

if($all<35)
{
return " You are too playful,sit tight next session"; 
} 
if($all>34 && $all<55)
{
return " A fairly  good result,put in more effort next session";

} 
if($all>54 && $all<64)
{
return " A good result,there is still room for improvement";
} 
if($all>=64 && $all<101)
{
return " An excellent result,do not relent your effort !";

}



}
else
{
if($all<35)
{
return " You are too playful,sit tight next term"; 
} 
if($all>34 && $all<55)
{
return " A fairly  good result,put in more effort next term";

} 
if($all>54 && $all<64)
{
return " A good result,there is still room for improvement";
} 
if($all>=64 && $all<101)
{
return " An excellent result,do not relent your effort !";

} 
}

}











function f_remarks($all,$promotion_info,$termuse)
{
if($termuse=="THIRD TERM")
{

if($promotion_info=="WITHDRAWN")
{
return "You are not serious at all,You are hereby withdrawn from the school"; 
}
if($promotion_info=="TO REPEAT")
{
return "You are to repeat your present class,you need to sit tight next session"; 
}
if($all>34 && $all<55 && $promotion_info=="TO RESIT")
{
return "A fairly good result but you will have to resit the failed core subject/s though"; 
}

if($all>54 && $all<65 && $promotion_info=="TO RESIT")
{
return "A good result but you will have to resit the failed core subject/s though"; 
}
 

if($all>=64 && $all<101 && $promotion_info=="TO RESIT")
{
return "An excellent result but you will have to resit the failed core subject/s though"; 
}

if($all<35)
{
return " A poor result,sit tight next session"; 
} 
if($all>34 && $all<55)
{
return " A fairly  good result,try hader next session";

} 
if($all>54 && $all<64)
{
return " A good result,you can still do better";
} 
if($all>=64 && $all<101)
{
return " An excellent result,do keep it up !";

}



}
else
{
if($all<35)
{
return " You are too playful,sit tight next term"; 
} 
if($all>34 && $all<55)
{
return " A fairly  good result,put in more effort next term";

} 
if($all>54 && $all<64)
{
return " A good result,there is still room for improvement";
} 
if($all>=64 && $all<101)
{
return " An excellent result,do not relent your effort !";

} 
}

}
?>