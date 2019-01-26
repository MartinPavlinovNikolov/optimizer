<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <p class="text-left lead text-info"><?= $this->content_for_printer; ?></p>
    </div>
</div>
<form class="form row" method="POST" action="<?= DOMAIN_CONTROLPANEL_MAKEPRINTER ;?>">
    <div class="row">
        <div class="col-md-4 text-right lead">
            <label for="printer-name"><?= $this->type_printer_name; ?></label>
        </div>
        <div class="col-md-4">
            <input name="printer_name" class="form-control text-center" id="printer-name" type="text" value="<?= $this->printer_name; ?>" placeholder="<?= $this->printer_name; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-right lead">
            <label for="printer-domain"><?= $this->type_printer_domain; ?></label>
        </div>
        <div class="col-md-4">
            <input name="printer_domain" class="form-control text-center" id="printer-domain" type="text" value="<?= $this->printer_domain; ?>" placeholder="<?= $this->printer_domain; ?>">
        </div>
    </div>
    <button type="submit" name="save" class="col-md-4 col-md-offset-4 btn btn-success"><?= $this->save; ?></button>
</form>