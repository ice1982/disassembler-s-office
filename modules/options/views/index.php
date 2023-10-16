<?php ?>
<br>
<?php if ($seasons == 'error'){ ?>
    Нет связи с БД!!!
<?php }else{ ?>
<div class="container-fluid font">
    <div class="row">
        <div class="form-group">
            <div class="col-xs-4">
                <div class="row">
                    <div class="col-xs-2 lh2_5"><b>Сезон:</b></div>
                    <div class="col-xs-4">
                        <select class="form-control font12" name="" id="years">
                            <option value="0"></option>
                            <?php foreach ($seasons as $season) { ?>
                                <option value="<?= $season->id ?>"><?= $season->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-2 lh2_5"><b>Неделя:</b></div>
                    <div class="col-xs-4">
                        <select class="form-control font12" name="" id="weeks">
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row content">

    </div>
</div>
<?php } ?>