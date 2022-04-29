<?php require_once (__DIR__ . "/../config/config.local.php") ?>

<div class="alert alert-danger" role="alert">
    Something went wrong, please try again!
</div>
<?php if (ALL_ERRORS_LOGGING || (isset($errorCode) && $errorCode === BusinessCardService::SEARCHING_ERROR_EMPTY_FIELD)): ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $errorMessage ?? "" ?>
    </div>
<?php endif; ?>