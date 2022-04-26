<?php
require_once("./app/HomeController.php");
include_once "./view/header.php";

$homeController = new HomeController();
$homeController->indexAction();
$errorMessage = $homeController->getErrorMessage();
$errorCode = $homeController->getErrorCode();
$businessCards = $homeController->getBusinessCards();
foreach ($homeController->getView() as $view) {include_once($view);}
include_once "./view/footer.php";
