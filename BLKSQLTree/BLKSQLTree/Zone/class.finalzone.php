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
require_once dirname(__FILE__)."/class.zone.php";
require_once dirname(__FILE__)."/class.finalattribute.php";
class FinalZone
{
    private $z;    
    private $id;

    public function getId()
    {
        return $this->id;
    }

    private function  __construct(&$z,$id)
    {
        $this->z=$z;
        $this->id=$id;
    }

    public static function  getRoot($cnn)
    {
        return new FinalZone(new Zone($cnn),null);
    }

    public function get($name)
    {
        return new FinalZone($this->z, $this->z->getId($this->id,$name));        
    }

    public function getParent()
    {
        if($this->id==null)
            return null;

        return new FinalZone($this->z, $this->z->getPid($this->id));
    }
        
    public function getName()
    {
        if($this->id==null)
            return null;

       return $this->z->getName($this->id);
    }

    public function getZones()
    {
        $t=array();

        foreach ($this->z->getZoneIds($this->id) as $sid)
            array_push ($t, new FinalZone ($this->z, $sid));

        return $t;
    }

    public function delete($recursive=true)
    {
        return $this->z->delete($this->id,$recursive);
    }

    public function getAttribute($name)
    {
        return new FinalAttribute($this->z->getAZ(), $this->id, $name);
    }
    
    public function getAttributes()
    {
        return $this->z->getAZ()->getAttributes($this->id);
    }
}
?>
