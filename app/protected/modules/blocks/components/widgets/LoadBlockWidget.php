<?php

class LoadBlockWidget extends CWidget
{
    public $alias;

    public function run()
    {
        $blocks = $this->getController()->blocks;
        if (isset($blocks[$this->alias])) {
            echo $this->getController()->decodeWidgets($blocks[$this->alias]);
        }
    }
}

?>