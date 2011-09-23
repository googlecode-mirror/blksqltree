<?php
/*
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 */

/**
 *
 * @author The Blankis < blankitoracing@gmail.com >
 */
require_once dirname(__FILE__)."/class.sql.php";
abstract class DataN
{
    private $cnn;
    private $tableName;
    private $tablePK;

    private $cache=array();

    private static function compareArray($data0, $data1)
    {
        foreach($data0 as $key0 => $value0)
        {
            if(!isset ($data1[$key0]))
                return false;

            if($data1[$key0]!=$value0)
                return false;
        }
        return true;
    }

    protected function  __construct($cnn,$tableName,$tablePK)
    {
        $this->cnn=$cnn;
        $this->tableName=$tableName;
        $this->tablePK=$tablePK;
    }

    protected function getId($data)
    {
        foreach($this->cache as $key => $value)
        {
            if(self::compareArray($data,$value)===true)
                    return $key;
        }

        $rs=$this->cnn->autoTable($this->tableName, $data, array($this->tablePK), true);
        return $rs[$this->tablePK];
    }

    protected function getValue($id)
    {
        if(isset ($this->cache[$id]))
                return $this->cache[$id];

        $rs=$this->cnn->select($this->tableName, array(), array($this->tablePK=>$id), 1);

        if(count($rs)==0)
            throw new Exception ("Invalid PK '$id' at ".$this->tableName);

        $rs=$rs[0];
        unset($rs[$this->tablePK]);

        $this->cache[$id]=$rs;

        return $rs;
    }

    protected function inUse($tableCol,$id)
    {
        foreach($this->cache as $data)
                if(isset ($data[$tableCol]) && $data[$tableCol]==$id)
                    return true;

        return count($this->cnn->select($this->tableName, array($tableCol), array($tableCol=>$id), 1))>0;
    }

    protected function delete($id)
    {
        if(!$this->cnn->delete($this->tableName, array($this->tablePK=>$id), 0))
                return false;

        unset ($this->cache[$id]);
        
        return true;
    }

    protected function getCnn()
    {
        return $this->cnn;
    }
}
?>
