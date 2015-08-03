<h1 class="text-center"><?= $data['title'] ?></h1>
<div class="pull-right">
    <a href="<?=__base_path__?>index/createEmail/<?= $data['uuid'] ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Email</a> |
    <a href="<?=__base_path__?>index/createPhone/<?= $data['uuid'] ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Phone Numbers</a> |
    <a href="<?=__base_path__?>index/createAddress/<?= $data['uuid'] ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Addresses</a>
</div>
<div class="clearfix"></div>
<hr>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr class="text-uppercase">
            <th>uuid</th>
            <th>name</th>
            <th>lastName</th>
            <th>photo</th>
            <th>description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['contacts'] as $key => $value):
            ?>

            <tr>
                <td><?= $value->uuid ?></td>
                <td><?= $value->name ?></td>
                <td><?= $value->lastName ?></td>
                <td><?= $value->photo ?></td>
                <td><?= $value->description ?></td>
                <td width="110px">
                    <a href="<?=__base_path__?>index/editContactInfo/<?= $value->uuid ?>" class="btn btn-warning btn-xs">Edit</a> |
                    <a href="" class="btn btn-danger btn-xs deleteData" data-table="contacts" data-id="<?= $value->id ?>" data-url="<?=__base_path__?>index/deleteData/<?= $value->id ?>" data-uuid="<?= $value->uuid ?>">Delete</a>
                </td>
            </tr>

        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</div>
<div class="clearfix"></div>
<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email</a></li>
        <li role="presentation"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab">Phone Numbers</a></li>
        <li role="presentation"><a href="#address" aria-controls="address" role="tab" data-toggle="tab">Addresses</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="email">
            <h1>Emails</h1>
            <?php
            $i = 1;
            foreach ($data['email'] as $key => $value):
                ?>
                <p>
                    <strong>Email <?=$i?> : </strong><?= $value->emails ?>
                    <span class="pull-right">
                        <a href="<?=__base_path__?>index/editEmail/<?= $value->id ?>" class="btn btn-warning btn-xs">Edit</a> |
                        <a href="" class="btn btn-danger btn-xs deleteData" data-table="emails" data-id="<?= $value->id ?>" data-url="<?=__base_path__?>index/deleteData/<?= $value->id ?>" data-uuid="<?= $value->uuid ?>">Delete</a>
                    </span>
                </p>
            <?php
            $i++;
            endforeach;
            ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="phone">
            <h1>Phone Numbers</h1>
            <?php
            $i = 1;
            foreach ($data['phone'] as $key => $value):
                ?>
                <p>
                    <strong>Number <?=$i?> : </strong><?= $value->numbers ?>
                    <span class="pull-right">
                        <a href="<?=__base_path__?>index/editPhone/<?= $value->id ?>" class="btn btn-warning btn-xs">Edit</a> |
                        <a href="" class="btn btn-danger btn-xs deleteData" data-table="phonenumbers" data-id="<?= $value->id ?>" data-url="<?=__base_path__?>index/deleteData/<?= $value->id ?>" data-uuid="<?= $value->uuid ?>">Delete</a>
                    </span>
                </p>
            <?php
            $i++;
            endforeach;
            ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="address">
            <h1>Addresses</h1>
            <?php
            $i = 1;
            foreach ($data['address'] as $key => $value):
                ?>
                <p>
                    <strong>Address </strong> <?=$i?> :
                    <span class="pull-right">
                        <a href="<?=__base_path__?>index/editAddress/<?= $value->id ?>" class="btn btn-warning btn-xs">Edit</a> |
                        <a href="" class="btn btn-danger btn-xs deleteData" data-table="addersses" data-id="<?= $value->id ?>" data-url="<?=__base_path__?>index/deleteData/<?= $value->id ?>" data-uuid="<?= $value->uuid ?>">Delete</a>
                    </span>
                </p>
                <p><strong>Name : </strong><?= $value->name ?></p>
                <p><strong>City : </strong><?= $value->city ?></p>
                <p><strong>Latitude : </strong><?= $value->latitude ?></p>
                <p><strong>Longitude : </strong><?= $value->longitude ?></p>
                <hr>
            <?php
            $i++;
            endforeach;
            ?>
        </div>
    </div>

</div>
