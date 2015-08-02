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
<form class="form-group col-lg-6" id="createEmail" action="<?=__base_path__?>index/createEmail/<?=$data['uuid']?>">
    <div class="form-group">
        <div class="form-group">
            <label>
                Email
            </label>
            <input type="text" name="emails" class="form-control" placeholder="Email" value="<?=$data['email']?>">
            <p class="help-block">Example Email or Email1;Email2;Email3;...EmailN</p>
        </div>
    <input type="submit" value="create email" class="btn btn-block btn-primary text-uppercase">
</form>