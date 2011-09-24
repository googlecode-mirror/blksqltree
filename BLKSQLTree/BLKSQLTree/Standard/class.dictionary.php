<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author andresrg
 */
class Dictionary
{
    private $zone;
    public function  __construct($root_zone)
    {

        $z=$root_zone;
        $z=$z->get("Standard");
        $z=$z->get("Dictionary");
        $this->zone=$z;
    }
    private static function procWord($word)
    {
        $t=$word;
        $t=strtoupper($t);


        $t = str_replace("Á", "A", $t);
        $t = str_replace("É", "E", $t);
        $t = str_replace("Í", "I", $t);
        $t = str_replace("Ó", "O", $t);
        $t = str_replace("Ú", "U", $t);

        return $t;
    }
    public  function getZone($word)
    {
        $z=$this->zone->get($this->getKeysWord($word));

        foreach (str_split($word) as $l)
            $z=$z->get($l);

        $z->getAttribute("len")->set(strlen($word));

        return $z;
    }

    private function getKeysWord($word)
    {
        $word=self::procWord($word);
        $b=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9");        

        $tmp="";
        foreach($b as $key)
            if(strpos($word,$key)!==false)
                    $tmp.=$key;

        return $tmp;
    }


    public function getWord($zone)
    {
        $len=$zone->getAttribute("len")->get();

        if(!is_numeric($len))
            return null;

        $word="";
        $z=$zone;
        for ($i=0;$i<$len;$i++)
        {
            $word=$z->getName().$word;
            $z=$z->getParent();
        }

        return $word;
    }

    private function getWords($zone,&$list=array())
    {
        foreach($zone->getZones() as $subzone)
                $this->getWords ($subzone,$list);
        
        $len=$zone->getAttribute("len")->get();
        

        if(is_numeric($len))
            array_push ($list, $this->getWord($zone));

        return $list;
    }

    public function search($word)
    {
        $list=array();
        $t=$this->getKeysWord($word);

        foreach($this->zone->getZones() as $zone)
        {
            $flag=true;
            $c1=$zone->getName();
            foreach (str_split($t) as $l)
            {
                if(strpos($c1,$l)===false)
                {
                    $flag=false;
                    break;
                }
            }

            if($flag)
                $this->getWords ($zone, $list);
        }

        return $list;
    }

}
?>