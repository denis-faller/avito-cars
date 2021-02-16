<?

Class AvitoCars{
    
    private $iblockId;
    private $url;
    private $quantityAllow;
    private $addressPropCode;
    private $carTypePropCode;
    private $makePropCode;
    private $modelPropCode;
    private $yearPropCode;
    private $kilometragePropCode;
    private $accidentPropCode;
    private $vinPropCode;
    private $bodyTypePropCode;
    private $doorsPropCode;
    private $generationIdPropCode;
    private $modificationIdPropCode;
    private $complectationIdPropCode;
    private $colorPropCode;
    private $fuelTypePropCode;
    private $engineSizePropCode;
    private $powerPropCode;
    private $transmissionPropCode;
    private $driveTypePropCode;
    private $wheelTypePropCode;
    private $ownersPropCode;
    private $imagesPropCode;
    
    public function __construct($iblockId, $url, $quantityAllow, 
            $addressPropCode,
            $carTypePropCode,
            $makePropCode,
            $modelPropCode,
            $yearPropCode,
            $kilometragePropCode,
            $accidentPropCode,
            $vinPropCode,
            $bodyTypePropCode,
            $doorsPropCode,
            $generationIdPropCode,
            $modificationIdPropCode,
            $complectationIdPropCode,
            $colorPropCode,
            $fuelTypePropCode,
            $engineSizePropCode,
            $powerPropCode,
            $transmissionPropCode,
            $driveTypePropCode,
            $wheelTypePropCode,
            $ownersPropCode,
            $imagesPropCode){
        $this->iblockId = $iblockId;
        $this->url = $url;
        $this->quantityAllow = $quantityAllow;
        $this->addressPropCode = $addressPropCode;
        $this->carTypePropCode = $carTypePropCode;
        $this->makePropCode = $makePropCode;
        $this->modelPropCode = $modelPropCode;
        $this->yearPropCode = $yearPropCode;
        $this->kilometragePropCode = $kilometragePropCode;
        $this->accidentPropCode = $accidentPropCode;
        $this->vinPropCode = $vinPropCode;
        $this->bodyTypePropCode = $bodyTypePropCode;
        $this->doorsPropCode = $doorsPropCode;
        $this->generationIdPropCode = $generationIdPropCode;
        $this->modificationIdPropCode = $modificationIdPropCode;
        $this->complectationIdPropCode = $complectationIdPropCode;
        $this->colorPropCode = $colorPropCode;
        $this->fuelTypePropCode = $fuelTypePropCode;
        $this->engineSizePropCode = $engineSizePropCode;
        $this->powerPropCode = $powerPropCode;
        $this->transmissionPropCode = $transmissionPropCode;
        $this->driveTypePropCode = $driveTypePropCode;
        $this->wheelTypePropCode = $wheelTypePropCode;
        $this->ownersPropCode = $ownersPropCode;
        $this->imagesPropCode = $imagesPropCode;
    }
    
    public function getCars(){
        $arrFilter = array("IBLOCK_ID"=>$this->iblockId, "ACTIVE" => "Y");
        
        $dbRes = CIBlockElement::GetList(array(), $arrFilter, false, false, array());
        
        $cars = [];

        while($obRes = $dbRes->GetNextElement()){
            $arRes = $obRes->GetFields();
			
			$cars[$arRes["ID"]]["quantity"] = CCatalogProduct::GetByID($arRes["ID"]);
            $cars[$arRes["ID"]]["quantity"] = $cars[$arRes["ID"]]["quantity"]["QUANTITY"];
            
            if(isset($arRes["DETAIL_PICTURE"])){
                $cars[$arRes["ID"]]["IMAGES"][0] = CFile::GetPath($arRes["DETAIL_PICTURE"]);
                $cars[$arRes["ID"]]["IMAGES"][0] = $this->url.$cars[$arRes["ID"]]["IMAGES"][0];
            }

            $props = $obRes->GetProperties();
            
            $cars[$arRes["ID"]]["ADDRESS"] = $props[$this->addressPropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["DESCRIPTION"] = $arRes["DETAIL_TEXT"];
            
            $cars[$arRes["ID"]]["CATEGORY"] = "Автомобили";
            $cars[$arRes["ID"]]["CAR_TYPE"] = $props[$this->carTypePropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["PRICE"] = CPrice::GetBasePrice($arRes["ID"]);
            $cars[$arRes["ID"]]["PRICE"] = intval($cars[$arRes["ID"]]["PRICE"]["PRICE"]);
            
            if(isset($props[$this->makePropCode]["VALUE"])){
                $cars[$arRes["ID"]]["MAKE"] = $props[$this->makePropCode]["VALUE"];
            }
            
            if(isset($props[$this->modelPropCode]["VALUE"])){
                $cars[$arRes["ID"]]["MODEL"] = $props[$this->modelPropCode]["VALUE"];
            }
            
            $cars[$arRes["ID"]]["YEAR"] = $props[$this->yearPropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["KILOMETRAGE"] = $props[$this->kilometragePropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["ACCIDENT"] = $props[$this->accidentPropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["VIN"] = $props[$this->vinPropCode]["VALUE"];

            $cars[$arRes["ID"]]["BODY_TYPE"] = $props[$this->bodyTypePropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["DOORS"] = $props[$this->doorsPropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["GENERATION_ID"] = $props[$this->generationIdPropCode]["VALUE"];
            
            $cars[$arRes["ID"]]["MODIFICATION_ID"] = $props[$this->modificationIdPropCode]["VALUE"];

            $cars[$arRes["ID"]]["COLOR"] = $props[$this->colorPropCode]["VALUE"]; 
            
            $cars[$arRes["ID"]]["FUEL_TYPE"] = $props[$this->fuelTypePropCode]["VALUE"]; 

            $cars[$arRes["ID"]]["ENGINE_SIZE"] = $props[$this->engineSizePropCode]["VALUE"]; 

            $cars[$arRes["ID"]]["POWER"] = $props[$this->powerPropCode]["VALUE"]; 
            
            $cars[$arRes["ID"]]["TRANSMISSION"] = $props[$this->transmissionPropCode]["VALUE"]; 
                    
            $cars[$arRes["ID"]]["DRIVE_TYPE"] = $props[$this->driveTypePropCode]["VALUE"]; 
            
            $cars[$arRes["ID"]]["WHEEL_TYPE"] = $props[$this->wheelTypePropCode]["VALUE"]; 
              
            $cars[$arRes["ID"]]["OWNERS"] = $props[$this->ownersPropCode]["VALUE"]; 
            
            foreach($props[$this->imagesPropCode]["VALUE"] as $morePhotoID){
               $cars[$arRes["ID"]]["IMAGES"][$morePhotoID] = CFile::GetPath($morePhotoID);
               $cars[$arRes["ID"]]["IMAGES"][$morePhotoID] = $this->url.$cars[$arRes["ID"]]["IMAGES"][$morePhotoID];
            }
        }
         
        return $cars;
    }

    public function getSimpleXmlElement($cars){
        $xmlstr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><Ads formatVersion=\"3\" target=\"Avito.ru\"></Ads>";
        $sxe = new SimpleXMLElement($xmlstr);
        
        foreach($cars as $key=>$value){
            if($this->quantityAllow && ($value["quantity"] <= 0)){
                continue;
            }
            else{
                $ad = $sxe->addChild('Ad');
                $id = $ad->addChild("Id", $key);

                $address = $ad->addChild("Address", $value["ADDRESS"]);

                $desc = $ad->addChild("Description");
                $node = dom_import_simplexml($desc);
                $no = $node->ownerDocument; 
                $node->appendChild($no->createCDATASection($value["DESCRIPTION"])); 


                $category = $ad->addChild("Category", $value["CATEGORY"]);
                $carType = $ad->addChild("CarType", $value["CAR_TYPE"]);
                $price = $ad->addChild("Price", $value["PRICE"]);
                $make = $ad->addChild("Make", $value["MAKE"]);
                $model = $ad->addChild("Model", $value["MODEL"]);
                $year = $ad->addChild("Year", $value["YEAR"]);
                $kilometrage = $ad->addChild("Kilometrage", $value["KILOMETRAGE"]);
                $accident = $ad->addChild("Accident", $value["ACCIDENT"]);
                $vin = $ad->addChild("VIN", $value["VIN"]);
                $bodyType = $ad->addChild("BodyType", $value["BODY_TYPE"]);
                $doors = $ad->addChild("Doors", $value["DOORS"]);
                $generationId = $ad->addChild("GenerationId", $value["GENERATION_ID"]);
                $modificationId = $ad->addChild("ModificationId", $value["MODIFICATION_ID"]);
                $color = $ad->addChild("Color", $value["COLOR"]);
                $fuelType = $ad->addChild("FuelType", $value["FUEL_TYPE"]);
                $engineSize = $ad->addChild("EngineSize", $value["ENGINE_SIZE"]);
                $power = $ad->addChild("Power", $value["POWER"]);
                $transmission = $ad->addChild("Transmission", $value["TRANSMISSION"]);
                $driveType = $ad->addChild("DriveType", $value["DRIVE_TYPE"]);
                $wheelType = $ad->addChild("WheelType", $value["WHEEL_TYPE"]);
                $owners = $ad->addChild("Owners", $value["OWNERS"]);
                
                $images = $ad->addChild("Images");
                foreach($value["IMAGES"] as $keyPhoto=>$photo){
                    if($photo != $this->url){
                        $img = $images->addChild("Image");
                        $img->addAttribute("url", $photo);
                    }
                }
            }
        }
        return $sxe;
    }
}

?>