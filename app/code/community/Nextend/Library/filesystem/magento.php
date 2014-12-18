<?php

class NextendFilesystem extends NextendFilesystemAbstract{
    
    function NextendFilesystem(){
        $this->_basepath = Mage::getBaseDir().DIRECTORY_SEPARATOR;
        $this->_cachepath = getNextend('cachepath', Mage::getBaseDir().DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'nextend'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR);
        $this->_librarypath = str_replace($this->_basepath, '', NEXTENDLIBRARY);
    }
    
    static function translateToMediaPath($path){
        $ps = explode('/plugins/', $path);
        if(isset($ps[1])){
            return NEXTENDLIBRARYASSETS.'plugins/'.$ps[1];
        }
        return $path;
    }
}