<?php ?>
<br>
<div class="row">
    <div class="form-group">
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-1 lh2_5"><b>Сезон:</b></div>
                <div class="col-xs-3 pad-left-0">
                    <select class="form-control" name="" id="years">
                        <?php foreach ($seasons as $season) { ?>
                            <option value="<?= $season->id ?>" <?= $season_id == $season->id?'selected':'' ?>><?= $season->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-5">
                    <select class="form-control" name="" id="fio" <?php if (!$this->userinfo->role){ ?>disabled<?php } ?>>
                        <?php foreach ($fio as $item) { ?>
                            <option value="<?= $item->id ?>" <?= $user_id == $item->id?'selected':'' ?>><?= $item->fio ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-3 pad-left-0 pad-right-0">
                    <span class="backtoyear lh2_5"><a href="https://data.instatfootball.tv/views_custom/cabinet/web/schedule/get_weeks/<?= $season_id ?>">Годовая таблица</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="ajax">
    <div class="row">
        <div class=" col-xs-6 head">
            <div class="row string">
                <div class="col-xs-2 lh2_5 data" data-week="<?= $week_id ?>" data-nweek="<?= $nweek ?>" data-uri="<?= $_SERVER['REQUEST_URI'] ?>">
                    <select name="sel_week" id="sel_week" class="form-control">
                        <?php foreach ($weeks as $item) { ?>
                            <option value="<?= $item->wk_id ?>" <?php if ($week_id == $item->wk_id) { ?>selected <?php } ?> data-wkn="<?= $item->wkn ?>"><?= $item->wk ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div
                    class="col-xs-2 lh2_5 pad-left-0"><?= $week->data_week[0]->wd . ' — ' . $week->data_week[6]->wd ?></div>
                <div class="col-xs-3 lh2_5 pad-right-0">Норма недели: <b><?= $weeks->{$week_id}->wdn ?></b> РД,
                    <b><?= $weeks->{$week_id}->nw ?></b> М
                </div>
                <div class="col-xs-3">
                    <select name="" id="type" class="form-control">
                        <option value="1" <?php if ($type == 1) { ?>selected<?php } ?>>Разборщик</option>
                        <?php if ($type == 2 || $this->userinfo->type == 2) { ?>
                            <option value="2" <?php if ($type == 2) { ?>selected<?php } ?>>Проверяющий</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-2 text-right lh2_5 "><b>
                        <?php if (/*($weeks->$week_id->fp > 0 && !$weeks->$week_id->hl) ||*/ $this->userinfo->role) { ?>
                            <?php if ($weeks->$week_id->hl && $this->userinfo->role){ ?>
                                <a id="hol2" style="cursor: pointer" data-hol="<?= $week->holiday_id ?>" data-week="<?= $week_id ?>" data-nweek="<?= $nweek ?>">Отменить отпуск</a>
                            <?php }else{ ?>
                                <a id="hol1" style="cursor: pointer" data-week="<?= $week_id ?>" data-nweek="<?= $nweek ?>">Взять отпуск</a>
                            <?php } ?>
                        <?php } ?>
                    </b>
                </div>

            </div>
            <br>
            <table class="table-bordered table" data-priz="<?= $week->priz_save ?>">
                <tr>
                    <th class="zagolovok text-center"></th>
                    <th class="zagolovok text-center"></th>
                    <th class="zagolovok text-center">0-8</th>
                    <th class="zagolovok text-center">8-12</th>
                    <th class="zagolovok text-center">12-16</th>
                    <th class="zagolovok text-center">16-20</th>
                    <th class="zagolovok text-center">20-24</th>
                </tr>
                <?php
                foreach ($week->data_week as $item) {
                    ?>
                    <tr data-curr_val="<?= $item->s1[0] . ',' . $item->s2[0] . ',' . $item->s3[0] . ',' . $item->s4[0] . ',' . $item->s5[0] ?>"
					data-day_id="<?= $item->id ?>">
                        <td class="text-center"><?= $item->wd ?><br><span
                                style="color: #cccccc"><?= $item->wds ?></span></td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if ($type == 1) { ?>
                                        <select class="form-control" name="" id="">
                                            <?php if (in_array($item->dn, [0, 1]) && $item->tp != 3) { ?>
                                                <option value="1.5">
                                                    <div>Рабочий день: 1.5 матч.</div>
                                                </option>
                                            <?php } elseif ($item->tp == 0 || ($this->userinfo->role && $item->tp != 3)) { ?>
                                                <option value="0.5" <?php if ($item->nr == 0.5 && $week->priz_save){ ?> selected <?php } ?>>
                                                    <div>Рабочий день: 0.5 матч.</div>
                                                </option>
                                                <option value="1" <?php if ($item->nr == 1 && $week->priz_save){ ?> selected <?php } ?>>
                                                    <div>Рабочий день: 1 матч.</div>
                                                </option>
                                                <option value="1.5" <?php if ($item->nr == 1.5 && $week->priz_save){ ?> selected <?php } ?>>
                                                    <div>Рабочий день: 1.5 матч.</div>
                                                </option>
                                                <option value="0" <?php if ($item->nr == 0 && $week->priz_save){ ?> selected <?php } ?>>
                                                    <div>Выходной день</div>
                                                </option>
                                            <?php } elseif ($item->tp == 1) { ?>
                                                <option value="<?= $item->nr ?>">
                                                    <div>Рабочий день: <?= $item->nr ?> матч.</div>
                                                </option>
                                            <?php } elseif ($item->tp == 2) { ?>
                                                <option value="0">
                                                    <div>Выходной день</div>
                                                </option>
                                            <?php } elseif ($item->tp == 3) { ?>
                                                <option value="0">
                                                    <div>Отпуск</div>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    <?php } elseif ($type == 2) { ?>
                                        <select class="form-control" name="" id="">
                                            <?php if (in_array($item->dn, [0, 1]) && $item->tp != 3) { ?>
                                                <option value="9">
                                                    <div>Рабочий день: 9 матч.</div>
                                                </option>
                                            <?php } elseif ($item->tp == 0 || ($this->userinfo->role && $item->tp != 3)) { ?>
                                                <option value="3" <?php if ($item->nr == 3 && $week->priz_save){ ?>selected <?php } ?>>
                                                    <div>Рабочий день: 3 матч.</div>
                                                </option>
                                                <option value="6" <?php if ($item->nr == 6 && $week->priz_save){ ?>selected <?php } ?>>
                                                    <div>Рабочий день: 6 матч.</div>
                                                </option>
                                                <option value="9" <?php if ($item->nr == 9 && $week->priz_save){ ?>selected <?php } ?>>
                                                    <div>Рабочий день: 9 матч.</div>
                                                </option>
                                                <option value="0" <?php if ($item->nr == 0 && $week->priz_save){ ?> selected <?php } ?>>
                                                    <div>Выходной день</div>
                                                </option>
                                            <?php } elseif ($item->tp == 1) { ?>
                                                <option value="<?= $item->nr ?>">
                                                    <div>Рабочий день: <?= $item->nr ?> матч.</div>
                                                </option>
                                            <?php } elseif ($item->tp == 2) { ?>
                                                <option value="0">
                                                    <div>Выходной день</div>
                                                </option>
                                            <?php } elseif ($item->tp == 3) { ?>
                                                <option value="0">
                                                    <div>Отпуск</div>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                        <td class="cells text-center <?= $item->s1[1] ?> <?php if ($item->tp) {
                            if ($item->s1[1] == 'j') { ?>selected <?php } else { ?>nselected<?php }
                        } ?>"
                            data-s="s1"><?= $item->s1[0] ?> <?= $item->s1[1] != 'w' ? 'М' : '' ?>
                            <?php if (isset($item->s1[2])) { ?>
                                <span><?= $item->s1[2] ?></span>
                            <?php } ?>
                        </td>
                        <td class="cells text-center <?= $item->s2[1] ?> <?php if ($item->tp) {
                            if ($item->s2[1] == 'j') { ?>selected <?php } else { ?>nselected<?php }
                        } ?>"
                            data-s="s2"><?= $item->s2[0] ?> <?= $item->s2[1] != 'w' ? 'М' : '' ?>
                            <?php if (isset($item->s2[2])) { ?>
                                <span><?= $item->s2[2] ?></span>
                            <?php } ?>
                        </td>
                        <td class="cells text-center <?= $item->s3[1] ?> <?php if ($item->tp) {
                            if ($item->s3[1] == 'j') { ?>selected <?php } else { ?>nselected<?php }
                        } ?>"
                            data-s="s3"><?= $item->s3[0] ?> <?= $item->s3[1] != 'w' ? 'М' : '' ?>
                            <?php if (isset($item->s3[2])) { ?>
                                <span><?= $item->s3[2] ?></span>
                            <?php } ?>
                        </td>
                        <td class="cells text-center <?= $item->s4[1] ?> <?php if ($item->tp) {
                            if ($item->s4[1] == 'j') { ?>selected <?php } else { ?>nselected<?php }
                        } ?>"
                            data-s="s4"><?= $item->s4[0] ?> <?= $item->s4[1] != 'w' ? 'М' : '' ?>
                            <?php if (isset($item->s4[2])) { ?>
                                <span><?= $item->s4[2] ?></span>
                            <?php } ?>
                        </td>
                        <td class="cells text-center <?= $item->s5[1] ?> <?php if ($item->tp) {
                            if ($item->s5[1] == 'j') { ?>selected <?php } else { ?>nselected<?php }
                        } ?>"
                            data-s="s5"><?= $item->s5[0] ?> <?= $item->s5[1] != 'w' ? 'М' : '' ?>
                            <?php if (isset($item->s5[2])) { ?>
                                <span><?= $item->s5[2] ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                } ?>
            </table>
        </div>
        <div class="col-xs-3">
            <br><br><br>
            <div class="row">
                <div class="col-xs-4" style="background-color: red; height: 30px;"></div>
                <div class="col-xs-8">— Норма не выполнена</div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-4" style="background-color: green; height: 30px;"></div>
                <div class="col-xs-8">— Норма выполнена</div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-4" style="background-color: yellow; height: 30px;"></div>
                <div class="col-xs-8">— Запланировано</div>
            </div>
			<?php if ($type == 1){ ?>
            <br><br>
            <div class="row">
                Объёмы :<br>&nbsp;&nbsp;&nbsp;более 1,6 = 1,5 матча<br>&nbsp;&nbsp;&nbsp;более 1,1 = 1 матч<br>&nbsp;&nbsp;&nbsp;более 0,5 = 0,5 матча<br>&nbsp;&nbsp;&nbsp;менее 0,5 = 0 матчей
            </div>
			<?php } ?>
        </div>
    </div>
    <?php if (!$week->priz_save || $this->userinfo->role) { ?>
        <div class="row">
            <div class="col-xs-6 text-right">
                <input id="save" class="btn btn-primary" data-d="<?= $weeks->{$week_id}->wdn ?>"
                       data-m="<?= $weeks->{$week_id}->nw ?>" type="button" value="Сохранить">
            </div>
        </div>
    <?php } ?>
</div>
<br>
<div class="table_of_year">

</div>
<div class="modal-body">

</div>
