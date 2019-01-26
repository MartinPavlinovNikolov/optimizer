<?php

foreach ($this->arrMenu as $pageNumber => $page) {
    echo '<div id= page-menu' . ($pageNumber - 1)
    . ' class="item"><p class="menu-page-header text-center" '
    . 'data-header="' . $page['header']
    . '">' . $page['header'] . '</p>';
    $j = 0;
    if (isset($page['items'])) {
        foreach ($page['items'] as $item) {
            $line_number = $j + 1;
            if ($j < 11) {
                $line_number = ' ' . $line_number;
            }
            echo '<p class="menu-page-item text-left bg-info" '
            . 'data-name="' . $item['name']
            . '" data-user-name="' . $item['user_name']
            . '" data-price="' . $item['price']
            . '" data-name="' . $item['name']
            . '" data-type = "' . $item['type']
            . '">' . $line_number . '-' . $item['name'] . '<span class="badge pull-right"></span></p>';
            $j++;
            unset($l);
        }
    }
    echo '</div>';
}