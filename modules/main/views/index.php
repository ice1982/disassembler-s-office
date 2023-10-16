<?php ?>
<div class="row periood">
	<div class="col-xs-6">
		<form action="" class="form-inline">
		
			<h4><?= $this->text[3] ?></h4>

			<div class="form-group">
				<label for="begin"> <?= $this->text[4] ?>: </label>
				<div class="input-group date datetimepicker">
					<input type="text" name="begin" class="form-control" id="begin">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label for="end"> <?= $this->text[5] ?>: </label>
				<div class="input-group date datetimepicker">
					<input type='text' name="end" id="end" class="form-control" />
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
			<div class="form-group">
				<input type="button" class="form-control btn-primary" value="<?= $this->text[6] ?>">
			</div>

		</form>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 tab1">

	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid tab2 text-center">

                </div>
            </div>
        </div>
    </div>
</div>
