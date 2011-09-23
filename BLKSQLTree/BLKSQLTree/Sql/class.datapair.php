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
require_once dirname(__FILE__)."/class.datan.php";
abstract class DataPair extends DataN
{
    private $tableCol;

    protected function  __construct($cnn,$tableName,$tablePK,$tableCol)
    {
        parent::__construct($cnn, $tableName, $tablePK);
        $this->tableCol=$tableCol;
    }

    protected function getId($value)
    {
        return parent::getId(array($this->tableCol => $value));
    }

    protected function getValue($id)
    {
        $rs=parent::getValue($id);
        return $rs[$this->tableCol];
    }
}
?>
