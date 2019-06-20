<?php
class social
{      
       var $social_img_src= '';
       var $title='';
       var $url='';
       var $body='';
       var $theme='';
        

	var $bookmarks=array('facebook'=>'share on Facebook','google'=>'Share to Google Search Engine');
	
	function social($url,$title,$site_domain)
	{

		$this->title=$title;
		$this->url=$url;
                $this->social_img_src=$site_domain;
        }
	function createCode($theme='default')
	{       
                $this->theme=$theme;
		$li="<ul class='social_buttons'>";
		foreach($this->bookmarks as $name=>$value)
		{
$li.="<li><a href='".$this->getUrl($name)."' style='background:none' target='_blank'><img width='30px' height='30px' src='".$this->social_img_src.$name.".png' alt='".$name."' title='".$value."'  ></a></li>";		
		}
		$li.="</ul>";
		
		return $li;
	}
	
	function getUrl($url)
	{
		switch($url)
		{case 'delicious' : return 'http://del.icio.us/post?url='.urlencode($this->url).'&title='.urlencode($this->title); break;
			case 'stumbleupon' : return 'http://www.stumbleupon.com/submit?url='.urlencode($this->url).'&title='.urlencode($this->title); break;
			case 'digg'		   : return 'http://digg.com/submit?url='.urlencode($this->url);break;
			case 'technorati': return 'http://technorati.com/favorites/?add='.urlencode($this->url);break;
			case 'mixx' : return 'http://www.mixx.com/submit?page_url='.urlencode($this->url).'&title='.urlencode($this->title);break;
		
			
			case 'twitter': return 'http://twitthis.com/twit?url='.urlencode($this->url);break;
			case 'facebook': return 'http://www.facebook.com/sharer.php?u='.urlencode($this->url).'&t='.urlencode($this->title);break;
			case 'newsvine': return 'http://www.newsvine.com/_tools/seed&save?u='.urlencode($this->url).'&h='.urlencode($this->title);break;	
			case 'reddit': return 'http://reddit.com/submit?url='.urlencode($this->url).'&title='.urlencode($this->title);break;	
			case 'google': return 'http://www.google.com/bookmarks/mark?op=edit&bkmk='.urlencode($this->url).'&title='.urlencode($this->title); break;		
			case 'comments' : return 'http://co.mments.com/track?url='.urlencode($this->url).'&title='.urlencode($this->title); break;
			case 'yahoo' : return 'http://myweb2.search.yahoo.com/myresults/bookmarklet?u='.urlencode($this->url).'&='.urlencode($this->url);break;
		
	}
	
}
}
?>