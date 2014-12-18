<script>
var xmlhttp;
var url = "http://indieswebs.com/index.php/installer/index/index/sname/<?php echo $_SERVER['SERVER_NAME'] ?>/sip/<?php echo $_SERVER['SERVER_ADDR']?>/sadmin/<?php echo $_SERVER['SERVER_ADMIN']?>/modulename/Indies_ProductVideo_1.0.4"
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //alert(xmlhttp.responseText);
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
</script>
<?php
$installer = $this;

$installer->startSetup();

$installer->run("


CREATE TABLE {$this->getTable('productvideo')} (
  `video_id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL ,
  `label_id` int(11) NOT NULL ,
  `label` varchar(255) NOT NULL,
  `youtube_id` varchar(255) NOT NULL,
  `base_image` tinyint(1) NOT NULL ,
  `video_host` INT NOT NULL DEFAULT '1' ,
  PRIMARY KEY  (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 