<p class="alert alert-success" id="createSuccess">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong></strong>
</p>
<p class="alert alert-danger" id="createError">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong></strong>
</p>
<form class="form-group col-lg-6" id="createContact" action="<?=__base_path__?>index/createContactInfo">
    <div class="form-group">
        <label>
            User ID<span style="color: red">*</span>
        </label>
        <input type="text" name="uuid" class="form-control" placeholder="User ID">
    </div>
    <div class="form-group">
        <label>
            Photo<span style="color: red">*</span>
        </label>
        <input type="text" name="photo" class="form-control" placeholder="Photo">
    </div>
    <div class="form-group">
        <label>
            Name<span style="color: red">*</span>
        </label>
        <input type="text" name="name" class="form-control" placeholder="Name">
    </div>
    <div class="form-group">
        <label>
            Last Name<span style="color: red">*</span>
        </label>
        <input type="text" name="lastName" class="form-control" placeholder="Last Name">
    </div>
    <div class="form-group">
        <label>
            Description<span style="color: red">*</span>
        </label>
        <textarea name="description" class="form-control" placeholder="Description"></textarea>
    </div>
    <input type="submit" value="create contact" class="btn btn-block btn-primary text-uppercase">
</form>