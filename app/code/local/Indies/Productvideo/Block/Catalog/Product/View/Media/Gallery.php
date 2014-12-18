<?php
abstract class Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery extends Mage_Catalog_Block_Product_View_Media
{
	const XML_PATH_LIGHTBOX2_GENERAL_TYPE = 'productvideo/general/type';
	const XML_PATH_LIGHTBOX2_GENERAL_MAXWIDTH = 'productvideo/general/max_width';
	const XML_PATH_LIGHTBOX2_GENERAL_MAXHEIGHT = 'productvideo/general/max_height';
	
	const XML_PATH_LIGHTBOX2_GENERAL_IMGWIDTH = 'productvideo/general/img_width';
	const XML_PATH_LIGHTBOX2_GENERAL_IMGHEIGHT = 'productvideo/general/img_height';
	const XML_PATH_LIGHTBOX2_GENERAL_IMGFRAME = 'productvideo/general/img_frame';
	const XML_PATH_LIGHTBOX2_GENERAL_THUWIDTH = 'productvideo/general/thu_width';
	const XML_PATH_LIGHTBOX2_GENERAL_THUHEIGHT = 'productvideo/general/thu_height';
	const XML_PATH_LIGHTBOX2_GENERAL_THUFRAME = 'productvideo/general/thu_frame';
	
	
	protected $_type = '';
	protected $_jsList = array();
	protected $_cssList = array();
	
	/* 
		Get Video Iframe for Base Image 
	
	*/
	protected function getVideoInformation($tag,$field)
	{
		$defaultValue=265;
		$storeId = Mage::app()->getStore()->getStoreId();
        $path = 'productvideo/'.$tag.'/'.$field;
        if(Mage::getStoreConfig($path, $storeId) == '')
		return $defaultValue;
		else
		return intval(Mage::getStoreConfig($path, $storeId));
	}
	protected function getYoutubeTheme($tag,$field)
	{
		
		$storeId = Mage::app()->getStore()->getStoreId();
        $path = 'productvideo/'.$tag.'/'.$field;
        return Mage::getStoreConfig($path, $storeId);
	}
	
	protected function getYoutubeIframe($id)
	{
		$youtube_width= $this->getVideoInformation('youtube','max_width');					
		$youtube_height= $this->getVideoInformation('youtube','max_height');
		$youtube_theme= $this->getYoutubeTheme('youtube','theme');
		$youtube_color= $this->getYoutubeTheme('youtube','control');
		$youtube_fullscreen=$this->getVideoInformation('youtube','full_screen');
		$youtube_autohide=$this->getVideoInformation('youtube','auto_hide');
		$youtube_play=$this->getVideoInformation('youtube','auto_play');
		echo "<iframe width='".$youtube_width."' height='".$youtube_width."' src='https://www.youtube.com/embed/".$id."?wmode=transparent&color=".$youtube_color."&autohide=".$youtube_autohide."&fs=".$youtube_fullscreen."&theme=".$youtube_theme."&autoplay=".$youtube_play."' frameborder='0' ></iframe>";
   
   	
   
   
   }
   protected function getVimeoIframe($id)
   {	
		$vimeo_width= $this->getVideoInformation('vimeo','max_width');					
		$vimeo_heigth= $this->getVideoInformation('vimeo','max_height');
		$vimeo_theme= $this->getYoutubeTheme('vimeo','theme');
		$vimeo_fullscreen=$this->getVideoInformation('vimeo','full_screen');
		$vimeo_play=$this->getVideoInformation('vimeo','auto_play');
		echo "<iframe width='". $vimeo_width."' height='".$vimeo_heigth."' 	src='http://player.vimeo.com/video/".$id."?portrait=1&color=".$vimeo_theme."&autoplay=".$vimeo_play."&fullscreen=".$vimeo_fullscreen." 'frameborder='0' ></iframe>";
   }
   protected function getDailymotionIframe($id)
   {
		$dailymotion_width= $this->getVideoInformation('dailymotion','max_width');					
	 	$dailymotion_heigth= $this->getVideoInformation('dailymotion','max_height');
		$dailymotion_play= $this->getVideoInformation('dailymotion','auto_play');
		$dailymotion_logo=$this->getVideoInformation('dailymotion','logo');
		$dailymotion_theme= $this->getYoutubeTheme('dailymotion','theme');
		echo "<iframe width='". $dailymotion_width."' height='".$dailymotion_heigth."' src='http://www.dailymotion.com/embed/video/".$id."?logo=".!$dailymotion_logo."&autoPlay=".$dailymotion_play ."&foreground=".$dailymotion_theme."' frameborder='0'></iframe>";
	}
	protected function getMetacafeIframe($id)
	{
		 $metacafe_width= $this->getVideoInformation('metacafe','max_width');					
		 $metacafe_heigth= $this->getVideoInformation('metacafe','max_height');
		 $metacafe_autoplay= $this->getVideoInformation('metacafe','auto_play');
		echo "<iframe src='http://www.metacafe.com/embed/".$id."/?ap='" .$metacafe_autoplay."' width='".$metacafe_width."'height='". $metacafe_heigth."'allowFullScreen='true' frameborder='0'></iframe>";
	}
	
	protected function getMaxWidth()
	{
		return intval(Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_MAXWIDTH));
	}
	
	/**
	 * Get image max height
	 *
	 * @return int
	 */
	
	
	protected function getMaxHeight()
	{
		return intval(Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_MAXHEIGHT));
	}
	
	/**
	 * Get image width
	 *
	 * @return int
	 */
	protected function getImageWidth()
	{
		return intval(Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_IMGWIDTH));
	}
	
	/**
	 * Get image height
	 *
	 * @return int
	 */
	protected function getImageHeight()
	{
		return intval(Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_IMGHEIGHT));
	}
	
	/**
	 * Display image frame
	 *
	 * @return int
	 */
	protected function getImageFrame()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_IMGFRAME) ? true : false;
	}
	
	/**
	 * Get image width
	 *
	 * @return int
	 */
	protected function getThumbnailWidth()
	{
		return intval(Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_THUWIDTH));
	}
	
	/**
	 * Get image height
	 *
	 * @return int
	 */
	protected function getThumbnailHeight()
	{
		return intval(Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_THUHEIGHT));
	}
	
	/**
	 * Display thumbnail frame
	 *
	 * @return int
	 */
	protected function getThumbnailFrame()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_THUFRAME) ? true : false;
	}
	
	/**
	 * Get lightbox type to be used
	 *
	 * @return string
	 */
	protected function _getLightboxType()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_TYPE);
	}
	
	/**
	 * Get a configuration parameter
	 *
	 * @param string $key
	 * @return string
	 */
	protected function getParam($key)
	{
		return Mage::getStoreConfig('productvideo/type-'.$this->_type.'/'.$key);
	}
	
	/**
	 * Get a configuration parameters as array
	 *
	 * @return array
	 */
	protected function getParams()
	{
		$return = array();
		$res = Mage::getStoreConfig('productvideo/type-'.$this->_type);
		
		foreach ($res as $k => $v)
		{
			if (is_numeric($v))
				$return[$k] = floatval($v);
			else
				$return[$k] = $v;
		}
		
		return $return;
	}
	
	protected function _prepareLayout()
	{
		if ($this->_getLightboxType() != $this->_type)
			return parent::_prepareLayout();
		
		foreach ($this->_jsList as $js)
			$this->getLayout()->getBlock('head')->addItem('skin_js', $js);
		
		foreach ($this->_cssList as $css)
			$this->getLayout()->getBlock('head')->addCss($css);
		
		return parent::_prepareLayout();
	}
	protected function getYoutubebox($id,$title,$isPrettyphoto)
	{
		
					$youtube_theme= $this->getYoutubeTheme('youtube','theme');
					$youtube_color= $this->getYoutubeTheme('youtube','control');
				    $youtube_fullscreen=$this->getVideoInformation('youtube','full_screen');										                    $youtube_autohide=$this->getVideoInformation('youtube','auto_hide'); 							                    $youtube_play=$this->getVideoInformation('youtube','auto_play');
					
				if(!$isPrettyphoto)
				{	
				echo "<li> <a class='indies_productvideo iframe' rel='indies_productvideo' title='". $title ."' href='https://www.youtube.com/embed/".$id."?autoplay=".$youtube_play."&theme=".$youtube_theme ."&autohide=".$youtube_autohide ."&color=".$youtube_color ."&fs=".$youtube_fullscreen ."'><img alt=".$title." src='http://img.youtube.com/vi/".$id."/1.jpg' width=56 height=65/> </a></li>";
		 		}
				else
				{
				echo "<li> <a class='indies_productvideo' rel='indies_productvideo' title='". $title ."' href='https://www.youtube.com/watch?v=".$id."?autoplay=".$youtube_play."&theme=".$youtube_theme ."&autohide=".$youtube_autohide ."&color=".$youtube_color ."&fs=".$youtube_fullscreen ."'><img alt='".$title."' src='http://img.youtube.com/vi/".$id."/1.jpg' width=56 height=65/> </a></li>"	;
				}
		
    }




	protected function getVimeobox($id,$title,$isPrettyphoto)
	{
					$vimeo_theme= $this->getYoutubeTheme('vimeo','theme');
					$vimeo_fullscreen=$this->getVideoInformation('vimeo','full_screen');
					$vimeo_play=$this->getVideoInformation('vimeo','auto_play');
					$imgid = $id;
					$hash = unserialize(file_get_contents(			                    "http://vimeo.com/api/v2/video/$imgid.php"));
					$image=$hash[0]['thumbnail_medium'];
					
	   		if(!$isPrettyphoto)
			{
				echo "<li><a class='indies_productvideo iframe' rel='indies_productvideo' title='".$title."' href='http://player.vimeo.com/video/".$id."?autoplay=".$vimeo_play."&fullscreen=".$vimeo_fullscreen."&color=".$vimeo_theme."'><img alt='".$title."' src='".$image."' width=56 height=65/>
                   </a></li>";
	
			}
			else
			{
				echo "<li><a class='indies_productvideo' rel='indies_productvideo' title='".$title." ' href='http://vimeo.com/".$id."?autoplay=".$vimeo_play."&fullscreen=".$vimeo_fullscreen."&color=".$vimeo_theme."'><img alt='".$title."' src='".$image."' width=56 height=65/></a></li>";
			}
			
	}

	protected function getDailymotionbox($id,$title,$isPrettyphoto)
	{
					$dailymotion_play= $this->getVideoInformation('dailymotion','auto_play');
					$dailymotion_logo=$this->getVideoInformation('dailymotion','logo');
				 	$dailymotion_theme= $this->getYoutubeTheme('dailymotion','theme');
		if(!$isPrettyphoto)
		{			
		echo"<li> <a class='indies_productvideo iframe' rel='indies_productvideo' title=' ".$title." ' href='http://www.dailymotion.com/embed/video/".$id."?autoplay=".$dailymotion_play."&logo=".$dailymotion_logo."&foreground=".$dailymotion_theme."'><img alt='".$title."' src=' http://www.dailymotion.com/thumbnail/video/".$id."' width=56 height=65/>
    			   </a></li>";
		}
		else
		{
		 echo"<li><a class='indies_productvideo' rel='indies_productvideo[iframe]' title='".$title." ' href='http://www.dailymotion.com/embed/video/".$id."?autoplay=".$dailymotion_play."&logo=". $dailymotion_logo ."&foreground=".$dailymotion_theme. "?iframe=true&amp;width=60% height=50%'><img alt='".$title."' src='http://www.dailymotion.com/thumbnail/video/".$id."'width=56 height=65 /></a></li>";
		}
	}
	protected function getMetacafebox($id,$title,$isPrettyphoto)
	{
		 $metacafe_autoplay= $this->getVideoInformation('metacafe','auto_play');
		
		if(!$isPrettyphoto)
		{
		echo "<li><a class='indies_productvideo iframe' rel='indies_productvideo' title='".$title."'  href='http://www.metacafe.com/embed/".$id."/?ap=".$metacafe_autoplay ."'><img alt='".$title."' src='http://s4.mcstatic.com/thumb/".$id."/0/4/directors_cut/0/1/sony_tablet_p_hands_on_would_you_use_it_technobuffalo.jpg ' width=56 height=65 /></a></li>";
		}
		else
		{
		
		 echo "<li><a class='indies_productvideo' rel='indies_productvideo[iframe]' title='".$title." ' href='http://www.metacafe.com/embed/".$id."/?ap=".$metacafe_autoplay."?iframe=true&amp;width=60% height=50%'><img alt=' ".$title."'src= 'http://s4.mcstatic.com/thumb/".$id."/0/4/directors_cut/0/1/sony_tablet_p_hands_on_would_you_use_it_technobuffalo.jpg'/></a></li>";
			
		}
		
		
	}
	protected function getFlashbox($id,$title,$isPrettyphoto)
	{
			 $parameter="video=".$id;
			 $path =Mage::getBaseUrl(). 'productvideo/video/video?'.$parameter;
			 $filename = basename($id, ".flv");
			 $imagepath =Mage::getBaseUrl('media'). 'productvideo/' . $filename.'.png';
			 $url = getimagesize($imagepath); //print_r($url); returns an array
 
			if (!is_array($url)) {
				
				//if file does not exists
				$imagepath=Mage::getDesign()->getSkinUrl('productvideo/player/flash.png');
				
			}
				
			
			if(!$isPrettyphoto)
			{
			echo "<li><a class='indies_productvideo iframe' title='".$title."' href=".$path."><img src='".$imagepath."' alt='".$title."' height='70' width='60' /></a></li>";
			}
			else
			{
				echo "<li><a href=".$path."?iframe=true&amp;width=60% height=50%
rel=indies_productvideo[iframe] title='".$title."' >
<img src='".$imagepath."' alt='".$title."'  height=70 width=60/></a></li>";
			}
	
	}
}

