<div class="col-xs-3 lh2_5 opt">
    <div class="row">
        <div class="col-xs-4"><b>Количество: </b></div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <input class="form-control" type="text" value="<?= $week->acw ?>">
                </div>
                <div class="col-xs-6 pad-right-0 pad-left-0">
                    разборщики
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <input class="form-control" type="text" value="<?= $week->ccw ?>">
                </div>
                <div class="col-xs-6 pad-right-0 pad-left-0">
                    проверяющие
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <input class="form-control" type="text"  value="<?= $week->ach ?>">
                </div>
                <div class="col-xs-6 pad-right-0 pad-left-0">
                    отпускные места (Р)
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <input class="form-control" type="text" value="<?= $week->cch ?>">
                </div>
                <div class="col-xs-6 pad-right-0 pad-left-0">
                    отпускные места (П)
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-4"><b>Нормы:</b></div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <input class="form-control" type="text" value="<?= $week->wd ?>">
                </div>
                <div class="col-xs-6 pad-right-0 pad-left-0">
                    рабочие дни
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <input class="form-control" type="text" value="<?= $week->anw ?>">
                </div>
                <div class="col-xs-6 pad-right-0 pad-left-0">
                    разборы
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-6" form-group>
                    <input class="form-control" type="text" value="<?= $week->chw ?>">
                </div>
                <div class="col-xs-6 pad-right-0 pad-left-0">
                    проверки
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-5">
    <div class="row">
        <div class="col-xs-3 text-right lh2_5">
            <b>Свободные места:</b>
        </div>
        <div class="col-xs-9">
            <table class="table-bordered table t1">
                <tr>
                    <th class="zagolovok"></th>
                    <th class="zagolovok">0-8</th>
                    <th class="zagolovok">8-12</th>
                    <th class="zagolovok">12-16</th>
                    <th class="zagolovok">16-20</th>
                    <th class="zagolovok">20-24</th>
                </tr>
                <?php foreach ($week->analyst_data as $item) { ?>
                    <tr>
                        <td><input class="form-control font12" disabled data-id="<?= $item->id ?>" type="text" value="<?= $item->day ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s1 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s2 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s3 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s4 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s5 ?>"></td>
                    </tr>
                <?php } ?>
            </table>
            <div class="row">
                <div class="col-xs-12 text-right pad-right-25">Разборщики</div>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-4">
    <div class="row">
        <div class="col-xs-11">
            <table class="table-bordered table t2">
                <tr>
                    <th class="zagolovok"></th>
                    <th class="zagolovok">0-8</th>
                    <th class="zagolovok">8-12</th>
                    <th class="zagolovok">12-16</th>
                    <th class="zagolovok">16-20</th>
                    <th class="zagolovok">20-24</th>
                </tr>
                <?php foreach ($week->checking_data as $item) { ?>
                    <tr>
                        <td><input class="form-control font12" disabled data-id="<?= $item->id ?>" type="text" value="<?= $item->day ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s1 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s2 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s3 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s4 ?>"></td>
                        <td class="cells"><input class="form-control" type="text" value="<?= $item->s5 ?>"></td>
                    </tr>
                <?php } ?>
            </table>
            <div class="row">
                <div class="col-xs-12 text-right">Проверяющие</div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <input id="save" class="btn btn-primary"  type="button" value="Применить">
        </div>
    </div>
</div>