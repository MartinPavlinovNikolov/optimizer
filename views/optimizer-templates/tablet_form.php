<form class="form-group hidden-md hidden-lg" name="form" method="POST" action="http://optimizer.com/application/optimizer/make-keyboard">
    <div class="row">
        <p class="text-center text-danger col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1"><?= $this->msg; ?></p>
    </div>
    <div class="row">
        <label for="user-name" class="col-form-label col-xs-1 col-sm-1"><?= $this->label1; ?></label>
        <div class="col-xs-9 col-sm-9 col-xs-offset-1 col-sm-offset-1">
            <input id="user-name" class="form-control text-center" type="text" name="user_name" placeholder="user name">
        </div>
    </div>
    <div class="row">
        <label for="magic-token" class="col-form-label col-xs-1 col-sm-1"><?= $this->label2; ?></label>
        <div class="col-xs-9 col-sm-9 col-xs-offset-1 col-sm-offset-1">
            <input id="magic-token" class="form-control text-center" type="text" name="magic_token" placeholder="magic token">
        </div>
    </div>
    <input class="btn btn-success col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2" type="submit" name="submit" value="submit">
</form>