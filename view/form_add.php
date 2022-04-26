<div class="mt-4 mb-4">
    <h3 class="text-center">Add a New Business Card:</h3>
</div>
<div class="row d-flex align-items-start justify-content-center ">
    <form class="col-md-4 mt-3" method="POST" action="">
        <div class="form-group">
            <label>Name</label>
            <input type="text" minlength="3" aria-required="true" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Surname</label>
            <input type="text" minlength="3" aria-required="true" class="form-control" name="surname">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" minlength="5" aria-required="true" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" minlength="6" aria-required="true" class="form-control" name="phone_number">
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="text" minlength="3" aria-required="true" class="form-control" name="company">
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="text" minlength="3" aria-required="true" class="form-control" name="position">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" value="true" name="hired">
            <label class="form-check-label">Check if this person is currently employed</label>
            <input type="hidden" value="form-add" name="form">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">Add</button>
        </div>
    </form>
</div>