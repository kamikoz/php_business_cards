<?php
require_once (__DIR__ . "/../config/config.local.php");

$errorMessage= $GLOBALS['errorMessage'] ?? "";
$errorCode= $GLOBALS['errorCode'] ?? 0;
?>

<?php if ($errorMessage !== ""): ?>
    <div class="alert alert-danger" role="alert">
        Something went wrong, please try again!
    </div>
<?php endif; ?>
<?php if ($errorCode === SEARCHING_ERROR_NO_EMPTY): ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $errorMessage ?>
    </div>
<?php endif; ?>
<?php if (session_status() == PHP_SESSION_NONE) session_start(); unset($_SESSION['error_message']);unset($_SESSION['error_code']); ?>