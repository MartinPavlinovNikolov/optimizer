<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <p class="lead"><?= $this->msg; ?></p>
    </div>
</div>
<form class="form" name="form-img" action="<?= DOMAIN_CONTROLPANEL_MAKEWALLPAPER ;?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <label class="custom-file">
                <input value="upload" name="file" type="file" id="file" class="btn custom-file-input">
                <span class="custom-file-control btn"></span>
            </label>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="tablet-review-top">
                <div class="tablet-review-frame">
                    <img class="img-cover" src="<?= $this->src; ?>">
                </div>
            </div>
            <div class="tablet-review-bottom">
                <div class="tablet-review-btn"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <button type="submit" name="submit" class="col-md-6 col-md-offset-3 btn btn-success btn-tall">
            <span class="glyphicon glyphicon-export"> <?= $this->upload; ?></span>
        </button>
    </div>
    <div class="row">
        <a href="<?= DOMAIN_CONTROLPANEL_MAKEWALLPAPER ;?>/back_to_default_image" class="col-md-6 col-md-offset-3 btn btn-warning btn-tall">
            <span class="glyphicon glyphicon-picture"> <?= $this->back_to_default_image; ?></span>
        </a>
    </div>
</form>