<div class="container-fluid tab2 text-center">
    <div>РАЗБОР И ПРОВЕРКА МАТЧЕЙ</div>
    <br>
    <div class="a_c_m_b_m">
        <div class="a_c_m_b_in"><b>Матч</b></div>
        <div class="a_c_m_b_in"><b>Команды</b></div>
        <div class="a_c_m_b_in"><b>Объем</b></div>
    </div>
    <div style="clear: both"></div>
    <hr>
    <?php foreach ($arr as $item) { ?>
        <div class="a_c_m_b_m">
            <div class="a_c_m_b_in"><?= $item->m ?></div>
            <div class="a_c_m_b_in"><?= $item->n ?></div>
            <div class="a_c_m_b_in"><?= $item->p ?></div>
        </div>
    <?php } ?>
</div>