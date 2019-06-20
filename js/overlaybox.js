var evt_gb=null;
var img_wit_gb=null;
function destroydim()
 {
    $("#overlay").css("display","none");
    $("#change_img").attr("src"," ");
 }

function large_image_close()
{
    var b=document.getElementById("img_con").style;
    document.getElementById('overlay').style.opacity = .0;
    b.opacity = .0;
    b.border="0px";
    b.width="0px";
    b.height="0px";
    setTimeout(' destroydim()',3000);
}

function open_dim()
{   
    document.getElementById("overlay").style.opacity = .7;
    document.getElementById("img_con").style.opacity = 1;
}

function f_resize()
{   
    if($("#overlay").css("display")==="none")
    {
    return;
    }
    else
    {
    var b=document.getElementById("img_con").style;
    var c=document.getElementById("change_img").style;
    pocess_lg_img(evt_gb,b,c);
    }
}

function large_image(evt)
{
    if(evt.target.nodeName!=="IMG")
    {
    return;
    }
    var img_src=evt.target.src;
    evt_gb=evt;
    var b=document.getElementById("img_con").style;
    var cr_im="<img id='change_img' class='img-responsive' src='"+img_src+"'/>";
    $("#img_con").html(cr_im);
    var c=document.getElementById("change_img").style;
    $("#overlay").css("display","block");
    b.display="block";
    setTimeout('open_dim()',100);
    pocess_lg_img(evt,b,c);
    b.border="2px groove #0a0a0a";
}
function  pocess_lg_img(evt,b,c)
{   
    var img_ht=evt.target.naturalHeight;
    var img_wit=evt.target.naturalWidth;
    var getwidth;
    var getheight=img_ht;
    var rm=$(window).width();
    var rh=$(window).height();
    if(img_wit>rm)
    {
    var scale=rm/img_wit;
    getwidth=rm;
    getheight=getheight*scale;
    getheight=Math.ceil(getheight);
    c.width=getwidth;
    c.height=getheight;
    rm=0;
    }
    else
    {
    getwidth=img_wit;
    c.width=getwidth;
    c.height=getheight;
    rm=rm-img_wit;
    rm=rm/2;
    rm=Math.floor(rm); 
    }


    getwidth=getwidth+"px";
    getheight=getheight+"px";
    rm=rm+"px";
    b.left=rm;
    b.right=rm;
    b.width=getwidth;
    b.height=getheight;
}