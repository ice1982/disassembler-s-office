<div class="row">
    <br>
    <div class="col-xs-8">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?= $this->text[9] ?></th>
                <th><?= $this->text[47] ?></th>
                <th><?= $this->text[48] ?></th>
                <th><?= $this->text[49] ?></th>
                <th><?= $this->text[9] ?></th>
                <th><?= $this->text[50] ?></th>
                <th><?= $this->text[51] ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if ($arr){ ?>
            <tr>
                <td><?= floatval($arr->rating_id) ?></td>
                <td><?= floatval($arr->deep_mark) ?></td>
                <td><?= floatval($arr->express_mark) ?></td>
                <td><?= floatval($arr->count_matches_week) > 0 ? $arr->count_matches_week / 2 : 0 ?></td>
                <td><?= floatval($arr->regularity_mark) ?></td>
                <td><?= floatval($arr->rating) ?></td>
                <td><?= $arr->frozen == 1 ? 'ДА' : '' ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>