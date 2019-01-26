<?= $this->getLayoutData('header'); ?>
<div>
    <div class="row fit">
        <div class="hidden-md hidden-lg text-center">
            <span class="text-primary col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">you need computer to manage your system</span>
            <span class="computer glyphicon glyphicon-alert col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4"></span>
        </div>
        <div class="hidden-xs hidden-sm col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1 col-xs-10 col-xs-offset-1 left-panel">
            <div id="main-container">
                <?= $this->getLayoutData('left_content'); ?>
            </div>
        </div>
        <div class="hidden-xs hidden-sm col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-10 col-xs-offset-1 right-panel">
            <div>
                <?= $this->getLayoutData('right_content'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->getLayoutData('footer'); ?>