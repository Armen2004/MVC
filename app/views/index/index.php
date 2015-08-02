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
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['contacts'] as $key => $value):
            ?>

            <tr>
                <td><a href="<?=__base_path__?>index/view/<?= $value->uuid ?>"><?= $value->uuid ?></a></td>
                <td><?= $value->name ?></td>
                <td><?= $value->lastName ?></td>
                <td><?= $value->photo ?></td>
                <td><?= $value->description ?></td>
            </tr>

        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</div>
