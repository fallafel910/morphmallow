<?php
class Indies_Productvideo_VideoController extends Mage_Core_Controller_Front_Action
{
    public function videoAction()
    {
		
		 $playerpath=Mage::getDesign()->getSkinUrl('productvideo/player/flowplayer-3.2.16.swf');
		 $videofile=$this->getRequest()->getParam('video');
		 $path =Mage::getBaseUrl('media'). 'productvideo/' .$videofile ;
		echo '<object width="100%" height="100%" type="application/x-shockwave-flash" data="'.$playerpath.'" name="fp_97432156_api" id="fp_97432156_api"><param value="true" name="allowfullscreen"><param value="always" name="allowscriptaccess"><param value="false" name="autoplay"><param value="high" name="quality"><param value="#000000" name="bgcolor"><param value="opaque" name="wmode"><param value="config={&quot;plugins&quot;:{&quot;controls&quot;:{&quot;volume&quot;:false}},&quot;playerId&quot;:&quot;fp_97432156&quot;,&quot;clip&quot;:{&quot;url&quot;:&quot;'.$path.'&quot;,&quot;autoPlay&quot;:false,&quot;autoBuffering&quot;: true,&quot;start&quot;: 62},&quot;playlist&quot;:[{&quot;url&quot;:&quot;'.$path.'&quot;}]}" name="flashvars"></object>';
	}
}