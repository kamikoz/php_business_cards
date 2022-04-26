<div class="mt-4 mb-4">
    <h3 class="text-center">Search in Business Cards:</h3>
</div>
<div class="row d-flex align-items-start justify-content-center ">
    <form class="col-md-4 mt-3" method="POST" action="">
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
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hired" value="true" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Employed
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hired" value="false" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    No employed
                </label>
            </div>
        </div>
        <div class="form-group">
            <input type="hidden" value="<?php echo BusinessCardService::SEARCHING_METHOD_FORM ?>" name="<?php echo BusinessCardService::SEARCHING_METHOD_FORM ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">Search</button>
        </div>
    </form>
</div>