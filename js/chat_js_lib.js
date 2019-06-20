if (window.FormData) 
{
var privacy_group_id = null;
var water_mark_id=null;
var file_caption_con=null;
var file_caption_id=null;
var url;
}
var beepTone1="<audio id='msg_beep' autoplay='false' src='musics/msg.wav' type='audio/mp3'>Your browser does not support the audio element.</audio>";
var wait="<img  alt='processing' src='images/wait.gif' width=20 height=20 />";
var wait2="<img  alt='processing' src='images/waiting.gif' style='margin:auto;' width=200 height=20 />";
var ok="<img  alt='ok' src='../images/success.png' width=20 height=20 />";
var error="<font color='red'>X</font>"; 
var limitNum=14;
var con_num=0;
var threadId;
var pgt=document.getElementsByTagName("TITLE")[0];
var gb_ac ={cont:"fitech",innerHTML:"",title:"",msg_con:con_num,pageDefaultTitle:pgt.text};
//alert(pgt.text);
var az=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
var role="Super Administrator";
var role2="Chief Programmer";
var rol3="Chief Chairman";
var FitechTeam={};
var gb_con_id=['msg_con_bot'];
var gb_usn=['FITECHBOT'];
var base64TbRanKeys={};
var msgSnderAndKey={};


function fitech_http_post(url,ab,in_div,an)
{
    $.post(     
    url,
    ab,
    function(server_response,server_status,xhr_request_object)
    {
    if (xhr_request_object.readyState===4 && xhr_request_object.status===200 && server_status==="success")
    { 
    if(in_div!==null && an==="YES")
    {
    var x =gebi(in_div); 
    var comment_hoder =document.createElement('DIV');
    comment_hoder.style.display="none";
    comment_hoder.innerHTML=server_response;
    $(comment_hoder).insertAfter(x);
    $(comment_hoder).fadeIn(2000);
    }
    else if(in_div!==null && an==="REG")  
    {
    //alert(server_response);
    $("#"+in_div).html(server_response);         
    }
    else if(in_div!==null && an==="CAPTCHA")
    {
    alert(server_response); //"<img src='http://localhost/fitechbot/img/a01.png'/>"
    $("#"+in_div).html("<img src='"+server_response+"'/>"); 
    
    }
    else
    {
    document.getElementsByTagName("TITLE")[0].text=server_response;
    return;   
    }
    
    }
    }       
        );
}

function chat_perform_action (url,in_value,in_name)
{    
    $("#"+in_name).html(wait);
    var ab = {fitech_in_value:in_value,check_name:in_name};
    fitech_http_post(url,ab,in_name,"REG");
}

function like(post_id,author_name)
{    
    var likeit="likebtn_"+post_id;
    var url="like.php";
    document.getElementById(likeit).innerHTML="you <i class='icon-thumbs-up'> </i> this ";
    var ab = {post_id:post_id,post_author:author_name};
    fitech_http_post(url,ab,null); 
} 

 function check_no(evt,in_value,in_name)
{
    var b=$("#"+in_name);
    b.html(wait);
    var charCode =(evt.which)  ? evt.which:event.keyCode;
    if (charCode>31 && (charCode <48 || charCode >57))
    {
     return false;
    }
    if (in_value.length < 11)
    { 
    b.html(error);
     return;
    }
    else if(in_value.length > limitNum)
    {
    //in_value=in_value.substring(0,limitNum);
     return false;
    }
    else
    {
    b.html(ok);
    return;
    }
}
function nl2br(in_str)
{
   return in_str.replace(/(\r\n|\r|\n|\n\n)/gm,"<br>"); 
}

function rmov_ws(in_str)
{
    return in_str.replace(/(\r\n|\r|\n|\s|\n\n)/gm,""); 
}

function strip_tags(in_str)
{
   var a= in_str.replace(/<br>/gim, "\n");
   a=a.replace(/<?php/gim, " ");
   a=a.replace(/&nbsp;/gim, " ");
   while(a.indexOf("<")!==-1)
   {
   var ot = a.indexOf("<");
   var ct = a.indexOf(">")+ 1;
   var res = a.slice(ot,ct);
   var d=a.replace(res, " ");
   a=d;
   }
   return a;
}

function close_div(div_id)
{
    var b=$("#"+div_id);
    b.animate({fontSize:'1em'},"slow",
    function ()
    {
    b.animate({width:'50%'},"slow");
    b.slideUp("slow",
    function ()
    {
     b.remove();
    }
           );
      });
}

function hidepost(post_id)
{
var b=$("#"+post_id);
var check=b.css("display");
var changenav=$("#changenav_"+post_id);
b.fadeToggle("slow",function()
{
if(check==="none")
{
changenav.html("contract post<<");
}
else
{
changenav.html("read all>>");
}  
}
        );
}

function auto_refresh_page (url,in_div,an)
{     
    //alert(url);
    fitech_http_post(url,null,in_div,an);
}
function aut_refresh_post2(url,in_div)
{     
    
     $.post(
             url,         
    function(server_response,server_status,xhr_request_object)
    {
     if (xhr_request_object.readyState===4 && xhr_request_object.status===200 && server_status==="success")
    { 
     var matched=rmov_ws(server_response);
     //alert(server_response);
     if (matched==="nopost")
      {
         return;
      }
    var x =gebi(in_div); 
    var comment_hoder =document.createElement('DIV');
    comment_hoder.style.display="none";
    
    comment_hoder.innerHTML=server_response;
    $(comment_hoder).insertAfter(x);
    $(comment_hoder).fadeIn(2000);
    }
    }       
       );
}
function aut_refresh_post_group(url,in_div,group_codename)
{     
     //alert(group_codename);
     var ab = {group_codename:group_codename};
     $.post(
             url,  
             ab,
    function(server_response,server_status,xhr_request_object)
    {
     if (xhr_request_object.readyState===4 && xhr_request_object.status===200 && server_status==="success")
    { 
     var matched=rmov_ws(server_response);
     //alert(server_response);
     if (matched==="nopost")
      {
         return;
      }
    var x =gebi(in_div); 
    var comment_hoder =document.createElement('DIV');
    comment_hoder.style.display="none";
    
    comment_hoder.innerHTML=server_response;
    $(comment_hoder).insertAfter(x);
    $(comment_hoder).fadeIn(2000);
    }
    }       
       );
}

function captcha(url,in_div,an)
{   
    //alert(url);
    var ab = {captcha:an};
    fitech_http_post(url,ab,in_div,an);
}


function delFile(url,in_name,in_id)
{
    var in_div="img_"+in_id;   
    var ab = {filename:in_name,fileid:in_id};
    fitech_http_post(url,ab,in_div,"REG");
    //alert("motiwa ti pe, e don tey Herbert Macauly, Jaja of Opobo");
}

function getContent(url,in_id)
{
    var in_div="content_"+in_id;
    var in_div2="img_"+in_id;    
    var b=gebi(in_div).value;
    var ab = {contents:b,contentsid:in_id};
    fitech_http_post(url,ab,in_div2,"REG");
    //alert("motiwa ti pe, e don tey Herbert Macauly, Jaja of Opobo");
}

function  splashDollars ()
{     
    var url="auto_pop_msg.php";
    var in_div="p_con";
     $.post(
             url,         
    function(server_response,server_status,xhr_request_object)
    {
     if (xhr_request_object.readyState===4 && xhr_request_object.status===200 && server_status==="success")
    { 
    var x =gebi(in_div); 
    var comment_hoder =document.createElement('DIV');
    comment_hoder.style.display="none";
    
    
     var obj = JSON.parse(server_response);
     var snder_username=obj.snder_username;  
     var snder_fullname=obj.snder_fullname; 
     var msg_content=obj.msg_content; 
     var msg_con_id=obj.msg_con_id; 
      //var msgkey=msgSnderAndKey[msg_snder];
     var msgkey=obj.msg_key;
     msgkey=convertKey(msgkey).toString();
     msgkey= msgkey.split(",");
    //alert(msgkey.length);//exit();
    msg_content= base64decode(msg_content,msgkey);
     var output=msg_con(snder_username,snder_fullname,msg_content,msg_con_id);
    comment_hoder.innerHTML=output;
  // var o_id=comment_hoder.firstElementChild.id;
   //comment_hoder.firstElementChild.style.display="none";
   //o_id=o_id.replace("msg_con_","");
   //o_id=rmov_ws(o_id);
   $(comment_hoder).insertAfter(x);
   $(comment_hoder).fadeIn(2000);
  //var name =gebi( o_id).name; 
   crtMsgCon("evt",msg_con_id);
 
    }
    }       
            );
}

function msg_con(snder_username,snder_fullname,msg_content,msg_con_id)
{
 return "<div id='msg_con_"+msg_con_id+"' class='msg_con'><div class='close' title='double click to close' ondblclick=closeConMsg('msg_con_"+msg_con_id+"','"+snder_username+"');>X</div><div id='msg_header_"+msg_con_id+"' class='msg_header'>"+snder_fullname+"</div><div class='msg_con_inner'><div class='talk-bubble tri-right round  right-top'><div class='talktext'>"+snder_fullname+"<br>"+msg_content+"</div></div> <div id='almm_"+msg_con_id+"' class='almm'></div><span style='display:none;' id='pub_key_"+msg_con_id+"'></span></div><div class='msg_footer'><input type='text' id='"+msg_con_id+"' name='"+snder_username+"' onkeyup=sndMsg(event,'sndMsg.php') placeholder='your msg Here...' class='form-control' /></div></div>";  
}

function auto_refresh_msg (url)
{     
    //var ab = {fitech_in_value:in_value,check_name:in_name};
    //fitech_http_post(url,null,in_name);
    $.post(     
    url,
    function(server_response,server_status,xhr_request_object)
    {
    if (xhr_request_object.readyState===4 && xhr_request_object.status===200 && server_status==="success")
    { 
    tmp_num_msg=Number(strip_tags(server_response));
     
    if(tmp_num_msg>0)
    {
    splashDollars();
    if(tmp_num_msg===1)
    {
    var msgN="Message";   
    }
    else
    {
    msgN="Messages";   
    }
    pgt.text="You have " + tmp_num_msg + " Unread " + msgN;  
    //beepTone();
    msgNotice();
    return;
    }
    else
    {
    pgt.text=gb_ac.pageDefaultTitle;  
    }
    return;   
    }
    }       
        );
}







function del_photo_ajax(p_dir,p_id,url)
{
    var deleteit="img_"+p_id;   
    var r=confirm(" Are you sure you want to delete this photo ?")
    if(r===false)
    {
    return ;
    }
    else
    {
    var b=$("#"+deleteit);
    b.html(wait);
    var ab = {photo_name:p_dir,photo_id:p_id};
    $.post(
    url,
    ab,
    function(server_response,server_status,xhr_request_object)
    {
    if (xhr_request_object.readyState===4 && xhr_request_object.status===200 && server_status==="success")
    { 
    var matched=rmov_ws(server_response);
    if (matched!=="")
    {
    $("#file_caption").remove();   
    }
    b.html(server_response);
    }
    }       
    );
    }

}


function fitechFormControls(pgd,wmd,fd)
{
    
   if(pgd!==null)
   {   
   var privacy_group_elements = pgd.getElementsByTagName("input");
   for (var i=0 ; i < privacy_group_elements.length; i++ ) 
   {
   if(privacy_group_elements[i].checked===true)
   {
   var post_privacy_value=privacy_group_elements[i].value; 
   var post_privacy_name=privacy_group_elements[i].name; 
   }
   }
   fd.append(post_privacy_name,post_privacy_value);
   }
   if(wmd!==null && wmd.checked===true)
   {
   var water_mark_val=wmd.value;
   var water_mark_name=wmd.name;
   fd.append(water_mark_name,water_mark_val);   
   }
   
}

function fitechFileReader(in_file_id,fd)
{
   var len = in_file_id.files.length;
   for (var i = 0 ; i < len; i++ ) 
   {	
   var file = in_file_id.files[i];
   if (file.type.match(/image.*/)!==null) 
   {	
   if ( window.FileReader ) 
   {					
   var reader = new FileReader();
   reader.readAsDataURL(file);
   }
   if (fd) 
   {
   fd.append("file[]", file);
   }			
   }
   }

}

function fitechSubmitFormAjax(in_url,http_type,in_div,fd)
{
   if (fd) 
   {			
   $.ajax(
   {
   url: in_url,
   type: http_type,
   data: fd,
   processData: false,
   contentType: false,
   dataType:"html",
   success: function (res)
   {
   in_div.html(res);
   }
   });		
   }
}

function myFunction(event) 
{
   var x = event.keyCode;
   //x = String.fromCharCode(x);
}

function move_uf(url,info_div)
{
    alert(group_codename_val);
   var formdata=false;
   if (window.FormData) 
   {
   formdata = new FormData();
   privacy_group_id = document.getElementById("privacy_group");
   water_mark_id = document.getElementById("water_mark");
   file_caption_id=document.getElementById("caption");
   var group_codename_id=document.getElementById("group_codename");
   var info_div_id=document.getElementById(info_div);
 
   var http_type="POST";
   if(file_caption_id!==null)
   {
   var file_caption_val=file_caption_id.value;
   var file_caption_name=file_caption_id.name;
   formdata.append(file_caption_name,file_caption_val);     
   //alert(file_caption_val);
   }
   if(group_codename_id!==null)
   {
   var group_codename_val=group_codename_id.value;
   var group_codename_name=group_codename_id.name;
   formdata.append(group_codename_name,group_codename_val);     
   alert(group_codename_val);
   }  
   fitechFormControls(privacy_group_id,water_mark_id,formdata);
   
   if(info_div_id===null)
   {
   info_div=$("form").attr("id");
   }
   var b=$("#"+info_div);
   b.html(wait2);
   }
   fitechSubmitFormAjax(url,http_type,b,formdata);    
}

function fuf (in_fuf_id,url,info_div,inFileName)
{
   var formdata=false;
   var b=$("#"+info_div);
   if (window.FormData) 
   {
   formdata = new FormData();
   var http_type="POST";
   b.html(wait2);
   }
   var len = in_fuf_id.files.length;
   if(len>25)
   {
   b.html("<font color='red'>You cannot Upload more than 24 Photos in a Single Request</font>");
   return;
   }
   if(url.lastIndexOf("=")!==-1)
   {
    var paramPsn = url.lastIndexOf("="); //url.indexOf
   //var ct = a.indexOf(">")+ 1;
   var res = url.slice(paramPsn+1);
   formdata.append("group_codename",res); 
   //alert(res);
   }
   if(inFileName==="FitechReader")
   {
   fitechFileReader(in_fuf_id,formdata);
   }
   //alert(formdata.toString);exit();
   fitechSubmitFormAjax(url,http_type,b,formdata);
}

function f_r()
{
  //var all_con=document.getElementsByClassName("comone_pix_m");
  var all_con=$(".comone_pix_m");
  var num_con=all_con.length;
  for (var j=0 ; j < num_con; j++ ) 
   {
   var ot_id=$(all_con[j]).attr("id");
   sunday(ot_id);
   }
   f_resize();
}
function sunday(in_id)
{
    
  var pgd=document.getElementById(in_id);
  var img_ele = pgd.getElementsByTagName("img");
  var num_pix=img_ele.length;
  var a_h=[];
  var m_con_w= $("#"+in_id).width();
  //var m_con_h= $("#"+in_id).height();
  var aw=Math.ceil(m_con_w/num_pix);
  for (var i=0 ; i < num_pix; i++ ) 
   {
   var h=img_ele[i].naturalHeight;
   var w=img_ele[i].naturalWidth;
   var scale=aw/w;
   var nh=h*scale;
   nh=Math.ceil(nh);
   a_h[i]= nh;
   }
   a_h.sort(function(a, b){return b-a;});
   var max_h=a_h[0];
   for (i=0 ; i < num_pix; i++ ) 
   {
   var w=img_ele[i].naturalWidth;
   //if(w>aw)
   img_ele[i].width=(aw-10);
   img_ele[i].height=max_h;
   }
}
function gebi(in_id)
{
    return document.getElementById(in_id); 
}

function fitech_attr(name, value)  
{ 
    return "{"+name+":"+value+"}"; 
}

function fgod(in_ob)  
{    
    var j=" ";
    for(var x in in_ob)
    {
    j +=x+": " + in_ob[x] + ", "; 
    }
    alert(j);
    return;
}

function populateArray(in_arr)  //fn ftn
{
    var rk=[];
    if(rk.lastIndexOf(in_arr)===-1)
    {
    rk.push(in_arr);
    return rk;
    }
    else
    {
    return rk;
    }

}

function fce(ele_type,ab)
{
    var x= document.createElement(ele_type); 
    for (var j in ab) 
    {
    x.setAttribute(j,ab[j]);
    }
    return x;
}
function fitech_redir(in_url)
{
    window.location.href=in_url;
}
function change_privacy(p_val,pst_id,p_url)
{  
    var ab = {privacy:p_val,post_id:pst_id};
    fitech_http_post(p_url,ab,null); 
}