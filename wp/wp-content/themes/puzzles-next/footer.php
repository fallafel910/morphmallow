<?php
/**
 * The template for displaying the footer.
 *
 * @package puzzles
 */
?>
    </div><!-- #main -->
</div>
<script type="text/javascript">
//<![CDATA[
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>

<!-- Next footer-->
  <?php the_block('footer'); ?>
  <?php the_block('popup_opendialog_login'); ?>


<link rel="stylesheet" href="https://morphmallow.com/js/prototype/windows/themes/default.css"> 
<link rel="stylesheet" href="https://morphmallow.com/skin/frontend/base/default/css/lib/prototype/windows/themes/magento.css"> 
<link rel="stylesheet" href="https://morphmallow.com/skin/frontend/metros/jack/css/ma2_popuplogin/ma2popuplogin.css"> 
<script src="https://morphmallow.com/js/prototype/window.js" type="text/javascript"></script>
<script src="https://morphmallow.com/js/scriptaculous/scriptaculous.js" type="text/javascript"></script>

<?php wp_footer(); ?>

</body>
</html>