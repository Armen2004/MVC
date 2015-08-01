<?= $data['title'] ?>
<br>

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
                <td><a href="<?=__base_path__?>index/index/<?= $value['uuid'] ?>"><?= $value['uuid'] ?></a></td>
                <td><?= $value['name'] ?></td>
                <td><?= $value['lastName'] ?></td>
                <td><?= $value['photo'] ?></td>
                <td><?= $value['description'] ?></td>
                <td width="110px">
                    <a href="" class="btn btn-warning btn-xs">Edit</a> |
                    <a href="" class="btn btn-danger btn-xs">Delete</a>
                </td>
            </tr>

        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</div>
