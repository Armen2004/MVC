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
<form class="form-group col-lg-6" id="updateEmail" action="<?=__base_path__?>index/editEmail/<?=$data['email'][0]->id?>">
    <div class="form-group">
        <div class="form-group">
            <label>
                Email
            </label>
            <input type="text" name="emails" class="form-control" placeholder="Email" value="<?=$data['email'][0]->emails?>">
            <p class="help-block">Example example@example.com.</p>
        </div>
    <input type="submit" value="update email" class="btn btn-block btn-primary text-uppercase">
</form>