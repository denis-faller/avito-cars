<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("catalog"))
{
	ShowError(GetMessage("RICHSITE_CATALOG_MODULE_NOT_INSTALL"));
	return;
}


if($arParams["IBLOCK_ID"] == NULL){
    ShowError(GetMessage("RICHSITE_PARAMS_IBLOCK_NOT_EXIST"));
    return;
}

if(!$USER->isAdmin()){
    if(file_exists("saved_file.xml")){
        $APPLICATION->RestartBuffer();
        $arResult["sxe"] = simplexml_load_file("saved_file.xml");
    }
    else{
        $currentUrl = (CMain::IsHTTPS()) ? "https://" : "http://";
        
        $currentUrl .= $_SERVER["HTTP_HOST"];
        
        if($arParams["QUANTITY_ALLOW"] == "Y"){
            $quantityAllow = true;
        }
        else{
            $quantityAllow = false;
        }

        $avitoCars = new AvitoCars($arParams["IBLOCK_ID"], $currentUrl, $quantityAllow,
                $arParams["ADDRESS"],
                $arParams["CAR_TYPE"],
                $arParams["MAKE"],
                $arParams["MODEL"],
                $arParams["YEAR"],
                $arParams["KILOMETRAGE"],
                $arParams["ACCIDENT"],
                $arParams["VIN"],
                $arParams["BODY_TYPE"],
                $arParams["DOORS"],
                $arParams["GENERATION_ID"],
                $arParams["MODIFICATION_ID"],
                $arParams["COMPLECTATION_ID"],
                $arParams["COLOR"],
                $arParams["FUEL_TYPE"],
                $arParams["ENGINE_SIZE"],
                $arParams["POWER"],
                $arParams["TRANSMISSION"],
                $arParams["DRIVE_TYPE"],
                $arParams["WHEEL_TYPE"],
                $arParams["OWNERS"],
                $arParams["IMAGES"]);
        
        $arResult["cars"] = $avitoCars->getCars();
        
        if($arResult["cars"] == NULL){
            ShowError(GetMessage("RICHSITE_CARS_NOT_EXIST"));
            return;
        }
        
        $arResult["sxe"] = $avitoCars->getSimpleXmlElement($arResult["cars"]);

        $APPLICATION->RestartBuffer();

        if($arParams["SAVED_FILE"] != NULL){
            if($arParams["SAVED_FILE"] == "Y"){
                if(!file_exists("saved_file.xml")){
                    $arResult["sxe"]->asXML("saved_file.xml");
                }
            }
        }
    }
    $this->IncludeComponentTemplate();

    die;
}

?>