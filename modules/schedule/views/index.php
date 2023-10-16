<?php ?>
<br>
<div class="row">
    <div class="form-group">
        <div class="col-xs-3">
            <div class="row">
                <div class="col-xs-2 lh2_5"><b>Сезон:</b></div>
                <div class="col-xs-5">
                    <select class="form-control" name="" id="years">
                        <option value="0"></option>
                        <?php foreach ($seasons as $season) { ?>
                            <option value="<?= $season->id ?>"><?= $season->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>