<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выгрузка автомобилей на Авито");
?><?php
$APPLICATION->IncludeComponent(
	"richsite:avito-cars",
	"",
	Array(
	)
);?>