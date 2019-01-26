<?= $this->getLayoutData('header'); ?>
<div class="container">
    <div class="row fit">
        <div class="hidden-md hidden-lg text-center">
            <span class="text-primary col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">you need computer to manage your system</span>
            <span class="computer glyphicon glyphicon-alert col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4"></span>
        </div>
        <div class="hidden-xs hidden-sm col-md-6 col-md-offset-3 panel">
            <?= $this->getLayoutData('content'); ?>
        </div>
    </div>
    <div class="row">
        <div class="hidden-xs hidden-sm col-md-6 col-md-offset-3">
            <?= $this->getLayoutData('language'); ?>
        </div>
    </div>
</div>
<?= $this->getLayoutData('footer'); ?>