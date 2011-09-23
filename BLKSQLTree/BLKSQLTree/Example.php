<?php
include_once dirname(__FILE__).'/Zone/class.finalzone.php';
$cnn=Sql::getConnection("mysql",  array("Server" => "127.0.0.1","User" => "root","Password" => "","Database" => "blk_tree"));
$data= FinalZone::getRootZone($cnn);

function tree($parent)
{
    $d= "<li><a href='?Id=".$parent->getId()."'>".$parent->getName()."</a>";



    foreach ($parent->getZones() as $zone)
    {
          $d.= "<ul>";
          $d.= tree($zone);
          $d.= "</ul>";
    }

    return $d."</li>";
}








$a=$data->getZone("A");
$b=$data->getZone("B");
$c=$data->getZone("C");
    $ca=$c->getZone("CA");
    $cb=$c->getZone("CB");
    $cc=$c->getZone("CC");
$d=$data->getZone("D");



$o=$b->getAttribute("att1");
$o->set("valatt1");
echo $o->get();



echo tree($data);
?>
