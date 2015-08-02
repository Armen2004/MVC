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
<form class="form-group col-lg-6" id="createPhone" action="<?=__base_path__?>index/createPhone/<?=$data['uuid']?>">
    <div class="form-group">
        <div class="form-group">
            <label>
                Phone Number<span style="color: red">*</span>
            </label>
            <input type="text" name="phones" class="form-control" placeholder="Phone Number">
            <p class="help-block">Example Phone Number or Phone Number1;Phone Number2;Phone Number3;...Phone NumberN</p>
        </div>
        <input type="submit" value="create phone number" class="btn btn-block btn-primary text-uppercase">
</form>