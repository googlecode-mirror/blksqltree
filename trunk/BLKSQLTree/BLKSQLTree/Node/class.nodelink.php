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
require_once dirname(__FILE__)."/../Sql/class.datathree.php";
class ZoneLink extends DataThree
{
    private static $tableName="BLK_NODE_LINK";
    private static $tablePk="NODE_LINK_ID";
    private static $tableValue0="NODE_LINK_NAME_ID_A";
    private static $tableValue1="NODE_LINK_NAME_ID_B";

    public function __construct($cnn)
    {
        parent::__construct($cnn, self::$tableName, self::$tablePk, self::$tableValue0, self::$tableValue1);
    }

    public function getId($id_a,$id_b)
    {
        if($id_a<$id_b)
            return parent::getId($id_a,$id_b);
        elseif($id_a>$id_b)
            return parent::getId($id_b,$id_a);
        else
            throw new Exception ("Same id link");
    }

    public function getIdA($id)
    {
        return parent::getValue0($id);
    }

    public function getIdB($id)
    {
        return parent::getValue1($id);
    }
}
?>
