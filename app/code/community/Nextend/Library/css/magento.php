<?php

class NextendCssMagento extends NextendCss {

    function serveCSSFile($url) {
        echo '<link rel="stylesheet" href="' . $url . '" type="text/css" />';
    }
}