<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <p class="lead"><?= $this->msg; ?></p>
    </div>
</div>
<form class="form row" name="form-tablets" action="<?= DOMAIN_CONTROLPANEL_MAKETABLETS ;?>" method="POST">
    <div class="col-md-4 text-right">
        <label for="magic-code"><?= $this->magic_label; ?></label>
    </div>
    <div class="col-md-4">
        <input class="form-control text-center" id="magic-code" value="<?= $this->input_value; ?>" name="magic_code" type="text">
    </div>
    <button type="submit" name="submit" class="btn btn-success btn-tall col-md-2 col-md-offset-5">
        <span class="glyphicon glyphicon-export"> <?= $this->save; ?></span>
    </button>
</form>