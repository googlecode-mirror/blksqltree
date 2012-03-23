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
require_once dirname(__FILE__)."/class.datapair.php";
abstract class DataPair64 extends DataPair
{
    
    protected function  __construct(&$driver,$tableName,$tablePK,$tableCol)
    {
        parent::__construct($driver, $tableName, $tablePK, $tableCol);
    }

    protected function getId($value)
    {
        return parent::getId(base64_encode($value));
    }

    protected function getValue($id)
    {       
        return base64_decode(parent::getValue($id));
    }
}
?>
