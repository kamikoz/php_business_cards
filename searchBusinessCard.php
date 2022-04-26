<?php
require_once(__DIR__ . '/app/BusinessCardMySQLCRUD.php');

session_start();
?>

<?php include_once "./partials/header.php" ?>

    <body>
<?php include_once "./partials/errorMessage.php" ?>
<?php include_once "./partials/navBar.php" ?>
    <div class="mt-4 mb-4">
        <h3 class="text-center">Search Business Cards by Fields:</h3>
    </div>
<?php include_once "./partials/businessCardForm.php" ?>
<?php $_SESSION['form-type'] = "searching";?>
<?php include_once "./partials/footer.php" ?>