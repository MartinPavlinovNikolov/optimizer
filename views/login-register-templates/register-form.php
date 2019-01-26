<div class="form-group row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
        <p class="text-left lead text-primary"><?= $this->note_printer; ?></p>
        <p class="text-left lead text-primary"><?= $this->note2_printer; ?></p>
    </div>
</div>
<div class="form-group row">
    <label class="col-xs-12 col-sm-2 col-sm-offset-2 col-md-2 col-md-offset-2 col-form-label text-center" for="printer-name"><?= $this->printer; ?>:</label>
    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
        <input class="form-control text-center" id="rinter-name" type="text" name="printer-name" placeholder="<?= $this->name; ?>">
    </div>
</div>
<div class="form-group row">
    <label class="col-xs-12 col-sm-2 col-sm-offset-2 col-md-2 col-md-offset-2 col-form-label text-center" for="printer-domain"><?= $this->domain; ?>:</label>
    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
        <input class="form-control text-center" id="rinter-domain" type="text" name="printer-domain" placeholder="<?= $this->domain; ?>">
    </div>
</div>