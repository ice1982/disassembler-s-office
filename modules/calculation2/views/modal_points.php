<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
		<div class="modal-box-wide">
			<div class="modal-header">
				<span title="<?= $points["name"] ?>" class="text-bold fullname">
					<b><?= $points["name"] ?></b>
				</span>
				<span class="date-add-ex-points"><?= $points["period"] ?></span>
				<div class="modal-hide"></div>
			</div>
			<div class="modal-inner" style="max-height: 330px;">
				<form class="observable-modal-box form-person" id="person-form" data-person="433896">
					<?php foreach ($points['points'] as $key => $point) { ?>
						<div class="form-person__col">
							<div class="col-item">
								<span class="form-title"><b><?= $this->text[20] ?></b></span>
								<input type="text" class="form-input" value="<?= $point['sport'] ?>" readonly>
								<span title="Delete" class="remove-kit"></span>
							</div>
							<div class="col-item">
								<span class="form-title"><b><?= $this->text[65] ?></b></span>
								<input type="text" id="count_ex_point" name="count_ex_point" class="form-input req idecimal_2_int_4_minus" title="Quantity" value="<?= $point['point'] ?>" readonly>
							</div>

							<div class="col-item comment-baseline">
								<span class="form-title"><b><?= $this->text[40] ?></b></span>
								<textarea name="comment_ex_point" id="comment_ex_point" class="form-textarea req" title="Comment" readonly><?= $point['comment'] ?></textarea>
							</div>
						</div>
						<?php $array = array_keys($points["points"]);
						if (end($array) != $key) { ?>
							<hr class="line_split">
						<?php } ?><?php } ?>

					<div data-kit="1" class="add-kit-points " title="Add"></div>
					<br>
					<br>
					<br>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 5px;"><?= $this->text[66] ?></button>
			</div>
		</div>
	</div>
</div>