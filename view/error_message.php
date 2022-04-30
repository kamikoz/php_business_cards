<?php require_once (__DIR__ . "/../config/config.local.php") ?>

<div class="alert alert-danger" role="alert">
    Something went wrong, please try again!
</div>
<?php if (ALL_ERRORS_LOGGING || (isset($errorCode) && in_array($errorCode, USER_FRIENDLY_ERRORS))): ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $errorMessage ?? "" ?>
    </div>
<?php endif; ?>