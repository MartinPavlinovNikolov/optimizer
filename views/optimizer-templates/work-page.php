<div id="work-page">
    <div id="carousel-example-generic" class="col-xs-8 col-sm-8 carousel slide">
        <div id="slide-menu" class="carousel-inner">
            <?= $this->getLayoutData('slider'); ?>
        </div>
    </div>
    <div class="btns-top">
        <button id="left-arrow" class="btn btn-muted"><</button>
        <div id="current-table-order"></div>
        <button id="right-arrow" class="btn btn-muted">></button>
        <button id="add-order" class="btn btn-muted">+</button>
        <button id="drow-note" class="btn btn-muted btn-control">drow note</button>
        <button id="corection" class="btn btn-muted btn-control">corections</button>
        <button id="history" class="btn btn-muted btn-control">history</button>
    </div>
    <button id="atention" class="pull-right btn btn-mutes">!</button>
    <div class="btns-bottom">
        <button id="send-order" class="btn btn-muted btn-control" data-toggle="modal" data-target="#modal-order">send order</button>
        <button id="cancel-order" class="btn btn-info btn-control" data-toggle="modal" data-target="#modal-cancel">cancel order</button>
        <button id="send-total" class="btn btn-muted btn-control" data-toggle="modal" data-target="#modal-total">total</button>
    </div>
</div>
</div>