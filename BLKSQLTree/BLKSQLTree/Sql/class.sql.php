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
abstract class Sql
{

    public static function getConnection($driver_name,$params)
    {
        require_once dirname(__FILE__).'/driver.'.strtolower($driver_name).".php";
        return new $driver_name($params);
    }
    protected static function arrayToWhere($data)
    {
        $t=self::arrayToEqual($data);
        if($t!="")
            return " where ".$t;
        else
            return "";
    }
    protected static function arrayToEqual($data,$and="and")
    {
        $t="";
        foreach($data as $key => $value)
        {
            if($t!="")
                $t.=" $and ";
            
            if($value===null)
                $t.=$key." is null";
            else
                $t.=$key."='".$value."'";
        }
        return $t;
    }
    protected static function arrayToSelect($data)
    {
        $t="";
        foreach($data as $value)
        {
            if($t!="")
                $t.=",";

            $t.=$value;
        }
        if($t!="")
            return $t;
        else
            return "*";
    }

    protected static function arrayToInsert($data)
    {
        $t0="";
        $t1="";
        foreach($data as $key => $value)
        {
            if($t0!="")
                $t0.=",";

            if($t1!="")
                $t1.=",";
            
            $t0.=$key;

            if($value===null)
                $t1.="null";
            else
                $t1.="'".$value."'";
        }

        return "(".$t0.") VALUES (".$t1.")";
    }

    public abstract function count($table,$where=array());
    public abstract function select($table,$col=array(),$where=array(),$limit=100);
    public abstract function delete($table,$where=array(),$limit=100);
    public abstract function insert($table,$data=array());
    public abstract function update($table,$data=array(),$where=array(),$limit=0);
    public abstract function query($query);
    public abstract function command($query);

    public function selectCol($table,$col,$where=array(),$limit=100)
    {
        $out=array();

        foreach($this->select($table,array($col),$where,$limit) as $row)
                foreach($row as $value)
                    array_push ($out, $value);
        
        return $out;
    }

    public function autoTable($table,$data,$col=array(),$create=true)
    {
        $rs=$this->select($table,$col,$data, 1);

        if (count($rs)>0)
            return $rs[0];
        else if ($create)
        {
            if ($this->insert($table, $data))
            {
                $rs=$this->select($table,$col,$data, 1);

                if (count($rs)>0)
                    return $rs[0];
                else
                    throw new Exception("Fail to create on table $table: ".self::arrayToInsert($data));                   
            }             
            else
                throw new Exception("Fail to create on table $table: ".self::arrayToInsert($data));
        }
        else
            return null;
    }
}
?>