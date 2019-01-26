<div class="row">
    <div class="col-xs-12 col-sm-3 col-md-3 text-center text-info">
        <label for="language"><?= $this->choose_language; ?>: </label>
    </div>
    <div class="col-xs-10 col-sm-6 col-md-6">
        <select class="form-control" id="language">
            <?php
            $languages = array(English, Български, Ελαδα, Espaniol);
            $shortLanguages = array(en, bg, el, es);
            $flags = array(gb, bg, gr, es);
            $output = '';
            $countLang = count($languages);
            $j = null;
            for ($i = 0; $i < $countLang; $i++) {
                $output .= '<option data-lang="' . $shortLanguages[$i] . '"';
                if ($this->language == $shortLanguages[$i]) {
                    $output .= ' selected>';
                    $j = $i;
                } else {
                    $output .= '>';
                }
                $output .= $languages[$i];
                $output .= '</option>';
            }
            echo $output;
            ?>
        </select>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1">
        <span><?php echo '<i class="famfamfam-flag-' . $flags[$j] . '"></i>'; ?></span>
    </div>
</div>