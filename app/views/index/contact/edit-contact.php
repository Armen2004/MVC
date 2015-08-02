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
<form class="form-group col-lg-6" id="updateContact" action="<?=__base_path__?>index/editContactInfo/<?=$data['uuid']?>">
    <div class="form-group">
        <label>
            User ID<span style="color: red">*</span>
        </label>
        <input type="text" name="uuid" class="form-control" placeholder="User ID" value="<?=$data['contacts'][0]->uuid?>">
    </div>
    <div class="form-group">
        <label>
            Photo
        </label>
        <input type="text" name="photo" class="form-control" placeholder="Photo" value="<?=$data['contacts'][0]->photo?>">
    </div>
    <div class="form-group">
        <label>
            Name
        </label>
        <input type="text" name="name" class="form-control" placeholder="Name" value="<?=$data['contacts'][0]->name?>">
    </div>
    <div class="form-group">
        <label>
            Last Name
        </label>
        <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="<?=$data['contacts'][0]->lastName?>">
    </div>
    <div class="form-group">
        <label>
            Description
        </label>
        <textarea name="description" class="form-control" placeholder="Description"><?=$data['contacts'][0]->description?></textarea>
    </div>
    <input type="submit" value="update contact" class="btn btn-block btn-primary text-uppercase">
</form>