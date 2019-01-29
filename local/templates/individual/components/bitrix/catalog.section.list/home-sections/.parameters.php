<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "COUNT_ELEMENTS" => array("HIDDEN" => "Y"),
    "ADD_SECTIONS_CHAIN" => array("HIDDEN" => "Y"),
    "SECTION_FIELDS" => array("HIDDEN" => "Y"),
    "SECTION_USER_FIELDS" => array("HIDDEN" => "Y"),
    "TOP_DEPTH" => array("HIDDEN" => "Y"),
    "SEF_MODE" => array("HIDDEN" => "Y"),
    "SECTION_TITLE" => array(
        "NAME" => GetMessage("CATEGORIES_NAME_SECTION_TITLE"),
        "TYPE" => "STRING",
        "PARENT" => "BASE"
    ),
    "SECTION_LINK" => array(
        "NAME" => GetMessage("CATEGORIES_NAME_SECTION_LINK"),
        "TYPE" => "STRING",
        "PARENT" => "BASE"
    )
);