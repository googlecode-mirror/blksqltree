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
require_once dirname(__FILE__)."/../Sql/class.datapair64.php";
class ZoneName extends DataPair64
{
    private static $tableName="TREE_ZONE_NAME";
    private static $tablePk="ZONE_NAME_ID";
    private static $tableValue="ZONE_NAME_VALUE";

    public function  __construct($cnn)
    {
        parent::__construct($cnn, self::$tableName, self::$tablePk, self::$tableValue);
    }

    public function getId($value)
    {
        return parent::getId(strtoupper($value));
    }

    public function  getValue($id)
    {
        return strtoupper(parent::getValue($id));
    }
}
?>
