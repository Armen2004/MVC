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
<h1 class="text-center"><?= $data['title'] ?></h1>
<div class="text-center">
    <form class="form-inline" id="searchData" action="<?=__base_path__?>search/searchData">
        <div class="form-group">
            <select name="field" class="form-control" id="selectedField">
                <option value="" selected>Search By</option>
                <?php
                foreach($data['tables'] as $key => $val):
                ?>
                <optgroup label="<?=$key?>"">
                <?php
                    foreach($val as $key1 => $val1):
                    ?>
                    <option value="<?=$val1?>" data-table="<?=$key?>"><?=$val1?></option>
                    <?php
                    endforeach;
                        ?>
                </optgroup>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Search">
        </div>
        <input type="submit" value="search" class="btn btn-primary text-uppercase">
    </form>
</div>
<hr>
<div class="table-responsive">
    <pre id="searchResult" class="pre-scrollable"></pre>
</div>