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
<form class="form-group col-lg-6" id="createAddress" action="<?=__base_path__?>index/createAddress/<?=$data['uuid']?>">
    <div class="form-group">
        <label>
            Address<span style="color: red">*</span>
        </label>
        <input type="text" name="name" class="form-control" placeholder="Name">
    </div>
    <div class="form-group">
        <label>
            City<span style="color: red">*</span>
        </label>
        <input type="text" name="city" class="form-control" placeholder="City">
    </div>
    <div class="form-group">
        <label>
            Latitude<span style="color: red">*</span>
        </label>
        <input type="text" name="latitude" class="form-control" placeholder="Latitude">
    </div>
    <div class="form-group">
        <label>
            Longitude<span style="color: red">*</span>
        </label>
        <input type="text" name="longitude" class="form-control" placeholder="Longitude">
    </div>
    <input type="submit" value="create address" class="btn btn-block btn-primary text-uppercase">
</form>