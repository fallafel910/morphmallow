<?php

class NextendDatabase extends NextendDatabaseAbstract {

    var $read = null;
    
    var $write = null;
    
    var $prefix = '';
    
    var $query = '';
    
    var $nameQuote = '`';

    function NextendDatabase() {
        $this->prefix = Mage::getConfig()->getTablePrefix();
        $resource = Mage::getSingleton('core/resource');
        $this->read = $resource->getConnection('core_read');
        $this->write = $resource->getConnection('core_write');
    }

    function setQuery($query) {
        $this->query = str_replace('#__', $this->prefix, $query);
    }

    function query() {
        $this->write->query($this->query);
    }

    function queryParams($params = array()) {
        $this->write->query($this->query, $params);
    }

    function insert($table, $params) {
        $columns = array();
        $values = array();
        foreach($params AS $k => $p){
            $columns[] = $this->quoteName($k);
            $values[] = ':'.$k;
        }
        $sql = "INSERT INTO ".$table." (".implode(',',$columns).") VALUES (".implode(',',$values).")";
        $this->setQuery($sql);
        $this->queryParams($params);
    }

    function update($table, $params, $where = null) {
        $s = array();
        foreach($params AS $k => $p){
            $s[] = $this->quoteName($k). '=:'.$k;
        }
        if($where != null) $where = ' WHERE '.$where;
        $sql = "UPDATE ".$table." SET ".implode(',',$s).$where;
        $this->setQuery($sql);
        $this->queryParams($params);
    }

    function loadAssoc() {
        try{
            return $this->read->fetchRow($this->query);
        }catch(Exception $e){
            echo $this->query;
            exit;
        }
    }

    function loadAssocList($key = null) {
        $rs = $this->read->fetchAll($this->query);
        if(!$key) return $rs;
        
        $re = array();
        foreach($rs AS $r){
          $re[$r[$key]] = $r;
        }
        return $re;
    }
    
    function escape($s){
        return $s;
    }

    function quote($s) {
        return $this->write->quote($s);
    }

    function quoteName($name) {
        if (strpos($name, '.') !== false) {
            return $name;
        }
        else {
            $q = $this->nameQuote;
            if (strlen($q) == 1) {
                return $q.$name.$q;
            } else {
                return $q{0}.$name.$q{1};
            }
        }
    }
    
    function insertid(){
        return $this->write->lastInsertId();
    }

}

?>
