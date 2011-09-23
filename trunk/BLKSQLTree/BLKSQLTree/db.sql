-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `blk_tree`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TREE_ATTRIBUTE`
--

CREATE TABLE IF NOT EXISTS `TREE_ATTRIBUTE` (
  `ATTRIBUTE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ATTRIBUTE_NAME_ID` int(11) NOT NULL,
  `ATTRIBUTE_VALUE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ATTRIBUTE_ID`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TREE_ATTRIBUTE_NAME`
--

CREATE TABLE IF NOT EXISTS `TREE_ATTRIBUTE_NAME` (
  `ATTRIBUTE_NAME_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ATTRIBUTE_NAME_VALUE` varchar(383) DEFAULT NULL,
  PRIMARY KEY (`ATTRIBUTE_NAME_ID`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TREE_ATTRIBUTE_VALUE`
--

CREATE TABLE IF NOT EXISTS `TREE_ATTRIBUTE_VALUE` (
  `ATTRIBUTE_VALUE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ATTRIBUTE_VALUE_VALUE` text,
  PRIMARY KEY (`ATTRIBUTE_VALUE_ID`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TREE_ZONE`
--

CREATE TABLE IF NOT EXISTS `TREE_ZONE` (
  `ZONE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ZONE_PARENT_ID` int(11) DEFAULT NULL,
  `ZONE_NAME_ID` int(11) NOT NULL,
  PRIMARY KEY (`ZONE_ID`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TREE_ZONE_ATTRIBUTE`
--

CREATE TABLE IF NOT EXISTS `TREE_ZONE_ATTRIBUTE` (
  `ZONE_ATTRIBUTE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ZONE_ATTRIBUTE_ZONE_ID` int(11) NOT NULL,
  `ZONE_ATTRIBUTE_ATTRIBUTE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ZONE_ATTRIBUTE_ID`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TREE_ZONE_NAME`
--

CREATE TABLE IF NOT EXISTS `TREE_ZONE_NAME` (
  `ZONE_NAME_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ZONE_NAME_VALUE` varchar(383) DEFAULT NULL,
  PRIMARY KEY (`ZONE_NAME_ID`)
) ENGINE=MyISAM;