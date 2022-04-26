<?php if (session_status() == PHP_SESSION_NONE) session_start(); unset($_SESSION['form-type'])?>

<div class="row d-flex align-items-start justify-content-center ">
    <form class="col-md-4 mt-3" method="POST" action="./app/CreateBusinessCardPOST.php">
        <div class="form-group">
            <label>Name</label>
            <input type="text" minlength="3" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Surname</label>
            <input type="text" minlength="3" class="form-control" name="surname">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" minlength="5" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" minlength="6" class="form-control" name="phone_number">
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="text" minlength="3" class="form-control" name="company">
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="text" minlength="3" class="form-control" name="position">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" value="hired" name="hired">
            <label class="form-check-label">Check if this person is currently employed</label>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
</div>