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
<?php
print_r($data['phone']);
?>
<form class="form-group col-lg-6" id="updatePhone" action="<?=__base_path__?>index/editPhone/<?=$data['phone'][0]->id?>">
    <div class="form-group">
        <div class="form-group">
            <label>
                Phone Number<span style="color: red">*</span>
            </label>
            <input type="text" name="phones" class="form-control" placeholder="Phone Number" value="<?=$data['phone'][0]->numbers?>">
            <p class="help-block">Example 000 00 00-00-00.</p>
        </div>
        <input type="submit" value="update phone number" class="btn btn-block btn-primary text-uppercase">
</form>