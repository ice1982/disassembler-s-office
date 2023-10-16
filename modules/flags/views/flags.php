<div id="flags_list" style="position: absolute;box-shadow: 1px 2px 10px grey;z-index: 1;background-color: white">
	<?php foreach ($flags as $lang => $item) { ?>
        <span data-lang="<?= $lang ?>"><img src="/web/images/flags/<?= $item ?>" height="15" width="25" alt=""></span>
	<?php } ?>
</div>