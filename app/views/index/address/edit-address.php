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
<form class="form-group col-lg-6" id="updateAddress" action="<?=__base_path__?>index/editAddress/<?=$data['address'][0]->id?>">
    <div class="form-group">
        <label>
            Address<span style="color: red">*</span>
        </label>
        <input type="text" name="name" class="form-control" placeholder="Name" value="<?=$data['address'][0]->name?>">
    </div>
    <div class="form-group">
        <label>
            City<span style="color: red">*</span>
        </label>
        <input type="text" name="city" class="form-control" placeholder="City" value="<?=$data['address'][0]->city?>">
    </div>
    <div class="form-group">
        <label>
            Latitude<span style="color: red">*</span>
        </label>
        <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="<?=$data['address'][0]->longitude?>">
    </div>
    <div class="form-group">
        <label>
            Longitude<span style="color: red">*</span>
        </label>
        <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="<?=$data['address'][0]->longitude?>">
    </div>
    <input type="submit" value="update address" class="btn btn-block btn-primary text-uppercase">
</form>