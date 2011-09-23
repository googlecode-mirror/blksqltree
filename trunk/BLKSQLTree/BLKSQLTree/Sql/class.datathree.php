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
abstract class DataThree extends DataN
{
    private $tableCol0;
    private $tableCol1;

    protected function  __construct($cnn,$tableName,$tablePK,$tableCol0,$tableCol1)
    {
        parent::__construct($cnn, $tableName, $tablePK);
        $this->tableCol0=$tableCol0;
        $this->tableCol1=$tableCol1;
    }

    protected function getId($value0,$value1)
    {
        return parent::getId(array($this->tableCol0 => $value0,$this->tableCol1 => $value1));
    }

    protected function getValue0($id)
    {
        $rs=parent::getValue($id);
        return $rs[$this->tableCol0];
    }

    protected function getValue1($id)
    {
        $rs=parent::getValue($id);
        return $rs[$this->tableCol1];
    }
}
?>
