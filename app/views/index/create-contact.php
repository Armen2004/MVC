<p class="alert alert-success" id="createContactSuccess">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong></strong>
</p>
<p class="alert alert-danger" id="createContactError">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong></strong>
</p>
<form class="form-group col-lg-6" id="createContact" action="<?=__base_path__?>index/createContactInfo">
    <div class="form-group">
        <label>
            User ID
        </label>
        <input type="text" name="uuid" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Photo
        </label>
        <input type="text" name="photo" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Name
        </label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Last Name
        </label>
        <input type="text" name="lastName" class="form-control">
    </div>
    <div class="form-group">
        <label>
            Description
        </label>
        <textarea name="description" class="form-control"></textarea>
    </div>
<!--    <div class="form-group">-->
<!--        <label>-->
<!--            Phone Number-->
<!--        </label>-->
<!--        <input type="text" name="phoneNumbers" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label>-->
<!--            Email-->
<!--        </label>-->
<!--        <input type="text" name="emails" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label>-->
<!--            Address-->
<!--        </label>-->
<!--        <input type="text" name="addersses" class="form-control">-->
<!--    </div>-->
    <input type="submit" value="create contact" class="btn btn-block btn-primary text-uppercase">
</form>