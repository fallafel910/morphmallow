<?php
define('NEXTENDLIBRARYASSETS', Mage::getBaseDir('media').DIRECTORY_SEPARATOR.'nextend'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR);

function nextendimportsmartslider2($key) {
    $keys = explode('.', $key);
    array_shift($keys);
    require_once(NEXTENDLIBRARY. '../SmartSlider2/library/' . implode(DIRECTORY_SEPARATOR, $keys) . '.php');
}

function nextendimportaccordionmenu($key) {
    $keys = explode('.', $key);
    array_shift($keys);
    require_once(NEXTENDLIBRARY. '../AccordionMenu/library/' . implode(DIRECTORY_SEPARATOR, $keys) . '.php');
}

function nextendSubLibraryPath($subLibrary) {
    if($subLibrary == 'smartslider') return NEXTENDLIBRARY. '../SmartSlider2/library/smartslider/';
    if($subLibrary == 'accordionmenu') return NEXTENDLIBRARY. '../AccordionMenu/library/accordionmenu/';
    return NEXTENDLIBRARY . $subLibrary . '/';
}