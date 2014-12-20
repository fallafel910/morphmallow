<?php
require_once 'app/Mage.php';
Mage::app();

$collection = Mage::getModel('catalog/product')
->getCollection()
->addAttributeToSelect('*');

foreach ($collection as $product) {
	echo $product->getName().' ';
	echo $product->getPriceModel()->getPrice($product);
?>
	<img style="float:left;" src="<?= Mage::helper('catalog/image')->init($product, 'thumbnail')?>"/>
	<br/>
<?php
}

?>