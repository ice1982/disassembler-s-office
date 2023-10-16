<br>
<div class="row">
    <div class="col-xs-4">
        <form action="/web/calculation" method="post" class="form-inline">
            <div class="form-group">
                <label for="f_pd_year"><?= $this->text[10] ?>&nbsp</label>
                <select name="f_pd_year" class="form-control" id="f_pd_year">
                    <?php
                    $i = date('Y',time());
                    $i--;
                    for ($c=$i+1;$c>=$i;$c--){
                        ?><option value="<?=$c?>"> <?=$c?> </option><?php
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="f_pd_month" style="padding-left: 5px;"><?= $this->text[11] ?>&nbsp</label>
                <select name="f_pd_month" class="form-control" id="f_pd_month">
                    <?php for ($i=1;$i<=12;$i++){
                        ?><option value="<?=$i?>" <?php if ($f_pd_month == $i){?>selected="selected"<?php } ?>><?=$months[$i]?></option><?php
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" style="margin-left: 5px;"><?= $this->text[6] ?></button>
            </div>
        </form>
    </div>
    <div class="col-xs-8"></div>
</div>
<?php if (isset($f_pd_year) && isset($f_pd_month)){
    ?><div class="row">
        <br>
        <div class="table col-xs-12"><table>
            <tr>
                <th class="zagolovok"></th>
                <th class="zagolovok"></th>
                <th class="zagolovok center" colspan="9"><?=$months[$f_pd_month]?> <?=$f_pd_year?> <?= $this->text[52] ?>.</th>
            </tr>
            <tr>
                <th class="zagolovok"><?= $this->text[12] ?></th>
                <th class="zagolovok"></th>
                <th class="zagolovok"><?= $this->text[13] ?></th>
                <th class="zagolovok"><?= $this->text[14] ?></th>
                <th class="zagolovok"><?= $this->text[15] ?></th>
                <th class="zagolovok"><?= $this->text[16] ?></th>
                <!--<th class="zagolovok">Премия (М)</th>
                <th class="zagolovok">Премия (К)</th>
                <th class="zagolovok">Премия (Г)</th>-->
                <th class="zagolovok"><?= $this->text[17] ?></th>
                <th class="zagolovok"><?= $this->text[18] ?></th>
            </tr><?php
            if (isset($premiya) && $premiya != false) {
                foreach ($premiya as $item) {
                    ?><tr data-id="<?= $item['user_id'] ?>"><?php
                    ?><td class="emploee"><?= $item['name'] ?></td><?php
                    ?><td class="emploee center"><?php
                    if ($item['career'] == 356) {
                        echo 'Р';
                    } elseif ($item['career'] == 323) {
                        echo 'П';
                    } elseif ($item['career'] == 320) {
                        echo 'СП';
                    } elseif ($item['career'] == 321) {
                        echo 'КР,П';
                    } elseif ($item['career'] == 322) {
                        echo 'КР';
                    }
                    ?><td class="emploee center"><?= $item['part_of']?$item['part_of']:'—' ?></td>
                    <td class="emploee center"><?= $item['part_of_marks']?$item['part_of_marks']:'—' ?></td>
                    <td class="emploee center"><?= $item['part_of_work']?$item['part_of_work']:'—' ?></td>
                    <td class="emploee center"><?= $item['summ']?number_format($item['summ'],2,',',''):'—' ?></td>
                    <!--<td class="emploee center"><?= ($item['prem']>0)?$item['prem']:'—' ?></td>
                    <td class="emploee center"><?=$item['prem_k']?$item['prem_k']:'—'?></td>
                    <td class="emploee center"><?=$item['prem_y']?$item['prem_y']:'—'?></td>--><?php
                    ?><td class="emploee center"><?=number_format(array_sum([$item['summ']/*, $item['prem_k'], $item['prem_y']*/]), 2, ',', '')?></td>
                    <td class="emploee center"><?=$item['currency']?$item['currency']:'—'?></td>
                    <?php
                    ?></tr><?php }
            }?></table></div>
        <br>
</div><?php } ?>