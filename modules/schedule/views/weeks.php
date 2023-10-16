<?php ?>
<br>
<div class="row">
    <div class="form-group">
        <div class="col-xs-4">
            <div class="row">
                <div class="col-xs-2 lh2_5"><b>Сезон:</b></div>
                <div class="col-xs-5">
                    <select class="form-control" name="" id="years">
                        <?php foreach ($seasons as $season) { ?>
                            <option value="<?= $season->id ?>" <?= $season_id == $season->id?'selected':'' ?>><?= $season->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="table_of_year">
    <div class="row">
        <div class="col-xs-12 bottom">
            <table class="table-bordered table-condensed">
                <tr>
                    <?php
                    $count = 0;
                    $a     = 0;
                    foreach ($weeks

                    as $week) {
                    if ($count == 0){
                    $count++;
                    $a++; ?>
                <tr>
                    <td class="week text-center <?= $week->hl ? 'green' : '' ?>
                    <?php
                    $t   = explode('—', $week->pw);
                    $e   = explode('.', $t[1]);
                    $end = date('Y-m-d', mktime(0, 0, 0, intval($e[1]), intval($e[0]), intval($e[2])));
                    if (date('Y-m-d') > $end) {
                        echo 'grey';
                    } ?>"
                        data-week="<?= $week->wk_id ?>"
                        data-nweek="<?= $a ?>"
                        data-sellers_id="<?= $sellers_id ?>"
                        style="font-size: 12px">
                        <div style="line-height: 1;padding-bottom: 8px;">
                            <?= $week->wk ?>
                            <br>
                            <span style="font-size: 10px"><?= $week->pw ?></span>
                        </div>
                        <?php if (!$week->hl) { ?>
                            <span style="font-size: 18px;"><?= $week->fp ?></span>
                        <?php } else { ?>
                            <div style="height: 8px;"></div>
                        <?php } ?>
                        <br>
                        <span style="font-size: 10px"><?= $week->wd ?></span>
                    </td>
                    <?php }elseif ($count == 9 || $a == count((array)$weeks)){
                    $count = 0; ?>
                    <td class="week text-center <?= $week->hl ? 'green' : '' ?>
                    <?php
                    $t   = explode('—', $week->pw);
                    $e   = explode('.', $t[1]);
                    $end = date('Y-m-d', mktime(0, 0, 0, intval($e[1]), intval($e[0]), intval($e[2])));
                    if (date('Y-m-d') > $end) {
                        echo 'grey';
                    } ?>"
                        data-week="<?= $week->wk_id ?>"
                        data-nweek="<?= $a += 1 ?>"
                        data-sellers_id="<?= $sellers_id ?>"
                        style="font-size: 12px">
                        <div style="line-height: 1;padding-bottom: 8px;">
                            <?= $week->wk ?>
                            <br>
                            <span style="font-size: 10px"><?= $week->pw ?></span>
                        </div>
                        <?php if (!$week->hl) { ?>
                            <span style="font-size: 18px;"><?= $week->fp ?></span>
                        <?php } else { ?>
                            <div style="height: 8px;"></div>
                        <?php } ?>
                        <br>
                        <span style="font-size: 10px;"><?= $week->wd ?></span>
                    </td>
                    </td>
                </tr>
                <?php } else {
                    $count++;
                    $a++; ?>
                    <td class="week text-center <?= $week->hl ? 'green' : '' ?>
                    <?php
                    $t   = explode('—', $week->pw);
                    $e   = explode('.', $t[1]);
                    $end = date('Y-m-d', mktime(0, 0, 0, intval($e[1]), intval($e[0]), intval($e[2])));
                    if (date('Y-m-d') > $end) {
                        echo 'grey';
                    } ?>"
                        data-week="<?= $week->wk_id ?>"
                        data-nweek="<?= $a ?>"
                        data-sellers_id="<?= $sellers_id ?>"
                        style="font-size: 12px">
                        <div style="line-height: 1;padding-bottom: 8px;">
                            <?= $week->wk ?>
                            <br>
                            <span style="font-size: 10px"><?= $week->pw ?></span>
                        </div>
                        <?php if (!$week->hl) { ?>
                            <span style="font-size: 18px;"><?= $week->fp ?></span>
                        <?php } else { ?>
                            <div style="height: 8px;"></div>
                        <?php } ?>
                        <br>
                        <span style="font-size: 10px"><?= $week->wd ?></span>
                    </td>
                    </td>
                <?php } ?>

                <?php } ?>
            </table>
        </div>
    </div>
</div>
