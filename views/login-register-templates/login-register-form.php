<form class="form row" name="login-register-form" action="<?= $this->action1; ?>" method="POST">
    <?= $this->getLayoutData('error_message'); ?>
    <div class="form-group row">
        <label class="col-xs-12 col-sm-2 col-sm-offset-2 col-md-2 col-md-offset-2 col-form-label text-center" for="username"><?= $this->name; ?>:</label>
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
            <input id="username" class="form-control text-center" type="text" name="username" placeholder="<?= $this->min; ?> 4 <?= $this->characters; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xs-12 col-sm-2 col-sm-offset-2 col-md-2 col-md-offset-2 col-form-label text-center" for="password"><?= $this->password; ?>:</label>
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
            <input class="form-control text-center" id="password" type="password" name="password" placeholder="<?= $this->min; ?> 8 <?= $this->characters; ?>">
        </div>
    </div>
    <?= $this->getlayoutData('printer_part') ;?>
    <button type="submit" class="col-xs-8 col-xs-offset-2  col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 btn <?= $this->color1 ;?> btn-tall" name="log">
        <span> <?= $this->login; ?> </span>
        <span class="glyphicon <?= $this->icon1 ;?>"></span>
    </button>
</form>
<div class="row">
    <a class="btn col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 <?= $this->color2 ;?> btn-tall" href="<?= $this->action2; ?>">
        <span><?= $this->btn2; ?></span>
        <span class="glyphicon <?= $this->icon2 ;?>"></span>
    </a>
</div>