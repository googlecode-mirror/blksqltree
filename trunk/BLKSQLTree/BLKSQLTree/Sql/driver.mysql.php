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
class mysql extends Sql
{
    private $server="127.0.0.1";
    private $database="test";
    private $user="test";
    private $password="";
    private $cnn=false;



    public function  __destruct()
    {
        $this->close();
    }
    protected function __construct($params)
    {
        if(isset ($params["Server"]))
            $this->server=$params["Server"];

        if(isset ($params["Database"]))
            $this->database=$params["Database"];

        if(isset ($params["User"]))
            $this->user=$params["User"];

        if(isset ($params["Password"]))
            $this->password=$params["Password"];


        $this->connect();
    }

    private function isConnected()
    {
        if($this->cnn===false)
            return false;
        else
            return mysql_ping ($this->cnn);
    }

    private function connect()
    {
        if($this->isConnected())
            $this->close();

        $this->cnn=mysql_connect($this->server, $this->user, $this->password);

        if (!$this->cnn)
        {
            throw new Exception(mysql_error(), mysql_errno());
            $this->close();
            return false;
        }

        if(!mysql_select_db($this->database, $this->cnn))
        {
            throw new Exception(mysql_error($this->cnn), mysql_errno($this->cnn));                 
            $this->close();
            return false;
        }
        return true;
    }


    private function close()
    {
        if (!$this->isConnected())
            return true;

        return !(mysql_close($this->cnn)===false);
    }

    private function query($query)
    {
	$t=microtime(true);
        $rs = mysql_query($query,$this->cnn);
        if (!$rs)
            throw new Exception(mysql_error($this->cnn).";$query",  mysql_errno($this->cnn));

	$t=microtime(true)-$t;
	//echo "  QUERY (".round($t,1).") : $query\n";

        $list=array();

        if (mysql_num_rows($rs) != 0)
            while ($row = mysql_fetch_assoc($rs))
                array_push ($list, $row);
	
        return $list;
    }

    private function command ($sql)
    {
	$t=microtime(true);

        $Result=mysql_unbuffered_query($sql,$this->cnn);

	$t=microtime(true)-$t;
	echo "COMMAND (".round($t,1).") : $sql\n";

        if ($Result===false)
        {
            trigger_error("command Error;".mysql_error($this->cnn).": ".$sql, E_USER_WARNING);
            return false;
        }
        else
            return true;
        
    }

    public function delete($table,$where=array(),$limit=100)
    {
        return $this->command("DELETE FROM ".$table.parent::arrayToWhere($where).self::getLimit($limit));
    }

    public function insert($table,$data=array())
    {
        return $this->command("INSERT INTO ".$table." ".parent::arrayToInsert($data));
    }

    public function select($table,$col=array(),$where=array(),$limit=100)
    {
        return $this->query("SELECT ".parent::arrayToSelect($col)." FROM ".$table.parent::arrayToWhere($where).self::getLimit($limit));
    }

    public function  update($table,$data=array(),$where=array(),$limit=0)
    {
        return $this->command("UPDATE ".$table." SET ".parent::arrayToEqual($data).parent::arrayToWhere($where));
    }

    private static function getLimit($limit)
    {
        if(is_numeric($limit) && $limit>0)
            return " LIMIT ".$limit.";";
        else
            return ";";
    }

    
}
?>
