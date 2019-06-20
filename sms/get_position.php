<?php
function get_position($in_x)
{
if($in_x==0 || $in_x==20 || $in_x==30 || $in_x==40 || $in_x==50 || $in_x==60 || $in_x==70 || $in_x==80 || $in_x==90)
{
return $position="st";

}
else if($in_x==1 || $in_x==21 ||$in_x==31 ||$in_x==41 ||$in_x==51 ||$in_x==61 ||$in_x==71 ||$in_x==81 ||$in_x==91)
{
 return $position="nd";
}

else if($in_x==2 || $in_x==22 || $in_x==32 || $in_x==42 || $in_x==52 || $in_x==62 || $in_x==72 || $in_x==82 || $in_x==92)
{
 return $position="rd";
}
else
{
return $position="th";

}



}

?>