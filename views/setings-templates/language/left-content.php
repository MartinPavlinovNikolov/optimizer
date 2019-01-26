<div class="row">
    <div class="col-md-4 text-right text-info">
        <label for="language"><?= $this->choose_language; ?>: </label>
    </div>
    <div class="col-md-4 btn-tall">
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
    <div class="col-md-1 btn-tall">
        <span><?php echo '<i class="famfamfam-flag-' . $flags[$j] . '"></i>'; ?></span>
    </div>
</div>