<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult['ITEMS']){
	foreach($arResult['ITEMS'] as $k => $arItem){
		/*$image = CFile::ResizeImageGet(
			$arItem['DISPLAY_PROPERTIES']['ICON_FILE']['FILE_VALUE'], 
			array(
				'width'=>41.25,
				'height'=>41.25
			), BX_RESIZE_IMAGE_PROPORTIONAL, true);   
		$arResult['ITEMS'][$k]['DISPLAY_PROPERTIES']['ICON_FILE']['FILE_VALUE']['SRC'] = $image['src'];*/
	}
}