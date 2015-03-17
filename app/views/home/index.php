<div class="col-lg-6">
    Hello
    <?php
//    Session::set('test', 'test');
//    print_r(Session::all());
//    Session::destroy();
//    print_r(Session::all());
    ?>
    <hr>

    <div id="database">
        <form method="post">
            <div class="input-group">
                <input type="text" name="database" class="form-control" required placeholder="Data base name">
                <span class="input-group-btn">
                    <button class="btn btn-warning" type="submit">Create database</button>
                </span>
            </div>
        </form>
    </div>
<hr>
    <div id="table" class="hidden">
        <form method="post" action="<?=__public_path__?>home/createTable" id="tableField">
            <div id="table_form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" name="table_name" class="form-control input" required placeholder="Table name">
                        </div>
                    </div>
                </div>
                <div class="row" data-id="0">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <input type="text" name="field_name_0" class="form-control input" required placeholder="Field name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="field_type_0" class="form-control input" required>
                                <option value="0">Select field type</option>
                                <option value="INT">INT</option>
                                <option value="VARCHAR">VARCHAR</option>
                                <option value="TEXT">TEXT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="number" name="field_length_0" class="form-control input" required placeholder="Field Length">
                        </div>
                    </div>
                </div>
            </div>


            <input type="hidden" name="database" id="databaseName">
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Create new table">
<!--                <button type="button" id="createTableButton" class="btn btn-warning">Create new table</button>-->
            </div>
        </form>
        <div class="form-group">
            <div class="input-group col-lg-6">
                <input type="number" name="maxFields" class="form-control col-lg-2" required placeholder="Fields" id="maxFields">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" id="add_new_field"><span class="glyphicon glyphicon-plus-sign"></span> Add new field</button>
                    </span>
            </div>
        </div>
    </div>


    <div id='data'></div>
<!--    --><?php
//    print_r($data['name']);
//    print_r(__public_path__);
//    ?>
</div>
<div class="col-lg-6">
    <div class="bs-example">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="tooltip" data-placement="top" title="Create new" id="create_new_database" href=""><span class="glyphicon glyphicon-plus-sign"></span> Create new DB</a>
                    </h4>
                </div>
            </div>
            <?php foreach($data['name'] as $key => $val) {?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key?>"><?=$key?></a>
                            <span class="pull-right">
                                <a data-toggle="tooltip" data-placement="top" title="Create new table" class="create_table" data-DB="<?=$key?>"><span class="glyphicon glyphicon-plus-sign"></span></a>
                                <a data-toggle="tooltip" data-placement="top" title="Edit DB" class="edit_DB" data-DB="<?=$key?>"><span class="glyphicon glyphicon-edit"></span></a>
                                <a data-toggle="tooltip" data-placement="top" title="Delete DB" class="delete_DB" data-DB="<?=$key?>"><span class="glyphicon glyphicon-minus-sign"></span></a></span>
                        </h4>
                    </div>
                    <div id="collapse<?=$key?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php foreach($val as $k => $v) {?>
                                <p><?=$v?>
                                    <span class="pull-right"> <a data-toggle="tooltip" data-placement="top" title="Edit table" class="edit_table" > <span class="glyphicon glyphicon-edit"></span></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Delete table" class="delete_table" data-table="<?=$key?>" data-id="<?=$v?>"><span class="glyphicon glyphicon-minus-sign"></span></a></span></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
