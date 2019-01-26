<?php
if ($this->arrMenu && is_array($this->arrMenu) && count($this->arrMenu) > 0) {
    foreach ($this->arrMenu as $pageNumber => $page) {
        ?>
        <div class = "row">
            <div class="col-md-12">
                <div class="row current-page">
                    <div class = "col-md-12">
                        <div class = "row">
                            <div class = "col-md-2">
                                <input class="form-control btn-page-number text-center" data-page-number="<?php echo $pageNumber; ?>" type="number" value="<?php echo $pageNumber; ?>">
                            </div>
                            <div class="col-md-6 col-md-offset-1">
                                <div class="row custom-panel">
                                    <div class = "col-md-2 btn-items-right text-center">
                                        <span class="lead glyphicon glyphicon-pencil"></span>
                                    </div>
                                    <div class = "col-md-7 col-md-offset-1 btn-items-left">
                                        <input class="form-control text-center" data-header-page-number="<?php echo $pageNumber; ?>" class = "header-name unit" type = "text" placeholder = "<?= $this->lang['placeholder-header']; ?>" value="<?php echo $page['header']; ?>">
                                    </div>
                                    <div class = "col-md-1">
                                        <button tabindex="-1" class="btn btn-danger btn-sm delete-this-page">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($page['items'])) {
                            foreach ($page['items'] as $item) {
                                $ci = $item['type'];
                                if ($ci == '1') {
                                    $location = $this->kitchen;
                                } else {
                                    $location = $this->bar;
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row custom-panel">
                                            <div class = "col-md-1 btn-items-right text-center">
                                                <span class="lead glyphicon glyphicon-pencil"></span>
                                            </div>
                                            <div class = "col-md-4 btn-items-left">
                                                <input data-item-name-page-number="<?php echo $pageNumber; ?>" class = "form-control text-center" type = "text" placeholder = "<?= $this->placeholder_item; ?>" value="<?php echo $item['name']; ?>">
                                            </div>
                                            <div class = "col-md-1 text-right btn-items-right">
                                                <span class="lead glyphicon glyphicon-eur"></span>
                                            </div>
                                            <div class = "col-md-2 btn-items-left">
                                                <input data-item-price-page-number="<?php echo $pageNumber; ?>" class = "form-control text-center" type = "number" placeholder = "<?= $this->placeholder_cost; ?>" value="<?php echo $item['price']; ?>">
                                            </div>
                                            <div class = "col-md-1 text-right btn-items-right">
                                                <span class="lead glyphicon glyphicon-refresh"></span>
                                            </div>
                                            <div class = "col-md-2 btn-items-left">
                                                <button data-item-type-page-number="<?php echo $pageNumber; ?>" data-item-type="<?php echo $ci; ?>" class = "btn btn-info"><?php echo $location; ?></button>
                                            </div> 
                                            <div class = "col-md-1">
                                                <button tabindex="-1" class = "btn btn-danger btn-sm delete-this-item">X</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class = "row">
                            <div class = "col-md-2 col-md-offset-9">
                                <button class = "glyphicon glyphicon-plus btn btn-success add-new-item"> <?= $this->btn_item; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}