<?php
require_once(__DIR__ . '/app/BusinessCardMySQLCRUD.php');

session_start();
$businessCards = [];
$errorMessage = $_SESSION['error_message'] ?? "";
$errorCode = $_SESSION['error_code'] ?? 0;

try {
    $businessCardCrud = new BusinessCardMySQLCRUD();
    $businessCards = $_SESSION['searching-result'] ?? $businessCardCrud->searchAll();
    unset($_SESSION['searching-result']);
} catch (Exception $e) {
    $GLOBALS['errorMessage'] = $e->getMessage();
    $GLOBALS['errorCode'] = $e->getCode();
}
?>
<?php include_once "./partials/header.php" ?>
    <body>
<?php include_once "./partials/errorMessage.php" ?>
<?php include_once "./partials/navBar.php" ?>
    <div class="mt-4 mb-4">
        <h3 class="text-center">List of Business Cards:</h3>
    </div>

<?php if (empty($businessCards)): ?>
    <div class="row d-flex align-items-start justify-content-center "> No result...</div>
<?php endif; ?>
<?php include_once "./partials/businessCardList.php" ?>
<?php include_once "./partials/footer.php" ?>