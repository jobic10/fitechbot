function checked_privacy($in_privacy,$in_username===null)
{
if($in_username!=null)
{
if($in_privacy==='anon') 
{
return "checked";
}
else if($in_privacy==='followers')
{
return "checked";
}
else if($in_privacy==='public')
{
return "checked";
}
else
{
return;
}

}
else
{
if($in_privacy===$in_username) 
{
return "checked";
}
else
{
return;
}

}

}