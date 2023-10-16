<br>
<div class="row">
	<div class="col-xs-4">
		<form action="/web/calculation2" method="post" class="form-inline" style="font-size: 12px">
			<div class="form-group">
				<label for="f_pd_year"><?= $this->text[10] ?>&nbsp</label>
				<select name="f_pd_year" class="form-control" id="f_pd_year">
					<?php
					$i = date('Y', time());
					$i--;
					for ($c = $i + 1; $c >= $i; $c--) {
						?>
					<option value="<?= $c ?>"> <?= $c ?> </option><?php
					} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="f_pd_month" style="padding-left: 5px;"><?= $this->text[11] ?>&nbsp</label>
				<select name="f_pd_month" class="form-control" id="f_pd_month">
					<?php for ($i = 1; $i <= 12; $i++) {
						?>
						<option value="<?= $i ?>" <?php if ($f_pd_month == $i){ ?>selected="selected"<?php } ?>><?= $months[$i][$this->lang] ?></option><?php
					} ?>
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" style="margin-left: 5px;"><?= $this->text[6] ?></button>
			</div>
		</form>
	</div>
	<div class="col-xs-8"></div>
</div><br><br>

<?php if (isset($data)) { ?>
		<table class="table">
			<?php foreach (isset($data->dates) ? $data->dates : [] as $week => $items) { ?>
			<?php if (!isset($data->array_agg[0]->analysis[$week])) continue ?>
				<thead>
				<tr class="header-row">
					<th class="col" colspan="7"><?= $this->text[53] ?></th>
					<th class="col" colspan="6"><?= $this->text[55] ?>:&nbsp;<?= $data->dates[$week][0]->short ?> - <?= $data->dates[$week][6]->short ?></th>
				</tr>
				<tr class="grey-header-row">
					<?php foreach (isset($data->dates) ? $data->dates[$week] : [] as $item) { ?>
						<th><?= $item->short ?></th>
					<?php } ?>
					<th class="col" style="min-width: 70px; padding-right: 20px;"><?= $this->text[53] ?></th>
					<th class="col" style="padding-right: 20px;"><?= $this->text[59] ?></th>
					<th class="col" style="padding-right: 20px;"><?= $this->text[60] ?></th>
					<th class="col" style="padding-right: 20px;"><?= $this->text[61] ?> 20%</th>
					<th class="col" style="padding-right: 20px;"><?= $this->text[62] ?></th>
					<th class="col" style="padding-right: 20px;"><?= $this->text[63] ?></th>
					<th class="col" style="padding-right: 20px;"><?= $this->text[17] ?></th>
					<th class="col br" style="min-width: 150px; padding-right: 15px;"><?= $this->text[18] ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach (isset($data->array_agg) ? $data->array_agg : [] as $item) { ?>
					<tr class="person-row bl">
						<?php $curr_date = date('Y-m-d', time()); $trigger = 0?>
						<?php foreach ($item->analysis[$week] as $analys) { ?>
							<?php if ($curr_date <= $analys->date) $trigger = 1 ?>
							<td><div class="<?php
							if ($analys->date < $curr_date) {
								if ($analys->fact > $analys->plan) {
									echo 'cellGreen';
								}
								if ($analys->fact < $analys->plan) {
									echo 'cellRed';
								}
								if ($analys->fact == $analys->plan && $analys->fact == 0 && $analys->plan == 0) {
									echo 'cellGrey';
								} else {
									if ($analys->fact == $analys->plan) {
										echo '';
									}
								}
							}
							?>"><span><?= (isset($analys->plan) && isset($analys->fact) ? $analys->plan . ' / ' . $analys->fact : '') ?></span></div></td>
						<?php } ?>
						<?php if ($trigger){ ?>
							<td class="bl"></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="br"></td>
						<?php } else { ?>
							<td class="bl"><div class="bw"><?= (isset($item->sums[$week]->plan_sum) && isset($item->sums[$week]->fact_sum) ? $item->sums[$week]->plan_sum . ' / ' . $item->sums[$week]->fact_sum : '') ?></div></td>
							<td><div class="bw"><?= $item->sums[$week]->stavka ?></div></td>
							<td><div class="bw"><?= $item->sums[$week]->base ?></div></td>
							<td><div class="bw"><?= $item->sums[$week]->bonus ?></div></td>
							<td><div class="bw points"
									 data-person="<?= $item->person_id ?>"
									 data-from="<?= $item->analysis[$week][0]->date ?>"
									 data-to="<?= $item->analysis[$week][6]->date ?>"
									 data-toggle="modal"
									 data-target="#points_modal">
									<?= isset($item->points[$week]) && $item->points[$week] != null ? round(array_sum($item->points[$week]), 2) : '' ?>
								</div>
							</td>
							<td ><div class="bw"><?= $item->sums[$week]->total ?></div></td>
							<td ><div class="bw"><?= $item->sums[$week]->total_curr ?></div></td>
							<td class="br"><div class="bw"><?= $item->iso ?></div></td>
						<?php } ?>
					</tr>
				<?php } ?>
				<tr><td></td></tr>
			<?php } ?>
				<?php
					if (isset($data->dates)) {
						$arr_dates  = array_keys($data->dates);
						$arr_dates2 = array_keys($data->dates[end($arr_dates)]);
					}
				?>
				<?php if (isset($trigger) && !$trigger) { ?>
					<tr>
						<td></td>
					</tr>
				<tr style="font-size: 12px; font-weight: bold">
					<td colspan="7"></td>
					<td colspan="5" style="padding-left: 20px;text-align: left; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;"><?= $this->text[56] ?>:
						<?= (isset($data->dates) ? $data->dates : false) ? $data->dates[0][0]->short . ' - ' . $data->dates[end($arr_dates)][end($arr_dates2)]->short : '' ?>
					</td>
					<td style="padding-left: 12px;border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;"><?= $item->total_per ?></td>
					<td style="padding-left: 12px;border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;"><?= $item->total_curr_all ?></td>
					<td style="padding-left: 12px;border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;"><?= $item->iso ?></td>
				</tr>
				<?php } ?>
				</tbody>
		</table>
	<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="points_modal">
	</div>
<?php } ?>