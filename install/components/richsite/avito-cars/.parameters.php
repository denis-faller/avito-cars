<?
CModule::IncludeModule("iblock");

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
	!empty($arCurrentValues['IBLOCK_TYPE'])
	? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
	: array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($arr, $rsIBlock, $iblockFilter);

$properties = CIBlockProperty::GetList(Array("name"=>"asc"), Array("IBLOCK_ID"=>$arCurrentValues['IBLOCK_ID']));
while ($propFields = $properties->GetNext()){
  $arProp[$propFields['CODE']] = '['.$propFields['ID'].'] '.$propFields['NAME'];
}

$arComponentParameters = array(
   "PARAMETERS" => array(
    "IBLOCK_TYPE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("IBLOCK_TYPE"),
        "TYPE" => "LIST",
        "VALUES" => $arIBlockType,
        "REFRESH" => "Y",
    ),
    "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_IBLOCK"),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
    ),
    "ADDRESS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_ADDRESS"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "CAR_TYPE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_CAR_TYPE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "MAKE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_MAKE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "MODEL" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_MODEL"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ), 
    "YEAR" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_YEAR"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "KILOMETRAGE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_KILOMETRAGE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "ACCIDENT" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_ACCIDENT"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "VIN" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_VIN"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "BODY_TYPE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_BODY_TYPE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),   
    "DOORS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_DOORS"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ), 
    "GENERATION_ID" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_GENERATION_ID"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "MODIFICATION_ID" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_MODIFICATION_ID"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),     
    "COLOR" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_COLOR"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "FUEL_TYPE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_FUEL_TYPE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "ENGINE_SIZE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_ENGINE_SIZE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "POWER" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_POWER"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),  
    "TRANSMISSION" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_TRANSMISSION"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "DRIVE_TYPE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_DRIVE_TYPE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),
    "WHEEL_TYPE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_WHEEL_TYPE"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),   
    "OWNERS" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_OWNERS"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),     
    "IMAGES" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("RICHSITE_IMAGES"),
        "TYPE" => "LIST",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProp,
        "REFRESH" => "Y",
    ),        
    "QUANTITY_ALLOW" => array(
        "NAME" => GetMessage("RICHSITE_QUANTITY_ALLOW"),
        "TYPE" => "CHECKBOX",
    ),
    "SAVED_FILE" => array(
        "NAME" => GetMessage("RICHSITE_SAVED_FILE"),
        "TYPE" => "CHECKBOX",
    ),   
   )
);
?>