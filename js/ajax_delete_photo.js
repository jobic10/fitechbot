
function ajax_delete_photo(str,p_id)

{
  
  var deleteit="img_"+p_id;   




var r=confirm(" Are you sure you want to delete this photo ?")
if (r==false)
  {
  return ;
  }
else

  {


   var xmlhttp;



 
   document.getElementById(deleteit).innerHTML="<font color='maroon'></font><img  alt='pls wait...' src='../images/wait.gif' width=50 height=50 />";
    

var url="ajax_delete_photo.php?";


url=url+"photo_name="+str;


var url=url+"&photo_id="+p_id;




     if (window.XMLHttpRequest)
     {
        xmlhttp=new XMLHttpRequest();
     }
     else if (window.XMLHttpRequest)
     {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
     else if (window.XMLHttpRequest)
     {
       xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");

     }

     else
     {
       alert("sorry your browser is way too old to surport this new technology,please consider using mozila firefox thank you !");
     return;
       
     }


xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

    
   document.getElementById(deleteit).innerHTML=" ";
  

       

    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.send();

}

}

























function ajax_delete_menu(str)

{
  
  var deleteit="menu_"+str;   




var r=confirm("Deleting a menu will delete all asociated documents, Are you sure you want to delete this menu ?")
if (r==false)
  {
  return ;
  }
else

  {
   

   var xmlhttp;


 
   document.getElementById(deleteit).innerHTML="<font color='maroon'></font><img  alt='pls wait...' src='../images/wait.gif' width=30 height=30 />";
    

var url="ajax_delete_menu.php?";


 url=url+"menu_name="+str;


//var url=url+"&photo_id="+p_id;


  

     if (window.XMLHttpRequest)
     {
        xmlhttp=new XMLHttpRequest();
     }
     else if (window.XMLHttpRequest)
     {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
     else if (window.XMLHttpRequest)
     {
       xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");

     }

     else
     {
       alert("sorry your browser is way too old to surport this new technology,please consider using mozila firefox thank you !");
     return;
       
     }


xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      
  
   document.getElementById(deleteit).innerHTML=xmlhttp.responseText;
 

    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.send();

}

}






var http = createRequestObject();
var areal = Math.random() + "";
var real = areal.substring(2,6);

function createRequestObject() {
	var xmlhttp;
	try { xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); }
  catch(e) {
    try { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    catch(f) { xmlhttp=null; }
  }
  if(!xmlhttp&&typeof XMLHttpRequest!="undefined") {
  	xmlhttp=new XMLHttpRequest();
  }
	return  xmlhttp;
}


function ajax_edit_news(p_id)

{
  
  var deleteit="img_"+p_id;   

 var y=escape(document.getElementById(p_id).value);


        
var r=confirm(" Are you sure you want to submit the changes you have made ?")
if (r==false)
  {
  return ;
  }
else

  {



 
   document.getElementById(deleteit).innerHTML="<font color='maroon'></font><img  alt='pls wait...' src='../images/wait.gif' width=50 height=50 />";
    





	try{
    http.open('POST',  'ajax_edit_news.php');
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
	try{
    if((http.readyState == 4)&&(http.status == 200)){
    	var response = http.responseText;

          
          
       document.getElementById(deleteit).innerHTML=" ";
  

         
     
    
 
		}
  }
	catch(e){}
	finally{}
}
		http.send('news_id='+p_id+'&contents='+y);
	}
	catch(e){}
	finally{}
}

}





















function ajax_delete_news(p_id)

{
  
  var deleteit="img_"+p_id;   




var r=confirm(" Are you sure you want to delete this news ?")
if (r==false)
  {
  return ;
  }
else

  {


   var xmlhttp;



 
   document.getElementById(deleteit).innerHTML="<font color='maroon'></font><img  alt='pls wait...' src='../images/wait.gif' width=50 height=50 />";
    

var url="ajax_delete_news.php?";


url=url+"news_id="+p_id;


     if (window.XMLHttpRequest)
     {
        xmlhttp=new XMLHttpRequest();
     }
     else if (window.XMLHttpRequest)
     {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
     else if (window.XMLHttpRequest)
     {
       xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");

     }

     else
     {
       alert("sorry your browser is way too old to surport this new technology,please consider using mozila firefox thank you !");
     return;
       
     }


xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

    
   document.getElementById(deleteit).innerHTML=" ";
  

       

    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.send();

}

}
