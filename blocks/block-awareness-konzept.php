<?php
function draw_language($name, $echo_name = null)
{
    if ($echo_name == null) {
        $echo_name = $name;
    }


    $language = 'deutsch';
    if (block_value($name)) {
?>
        <a href="<?php block_field($name); ?>" target="_blank">
            <?php echo $echo_name ?>
        </a>
<?php
    }
}
?>

<h2 style="padding-top: 3rem;"><strong>Awareness Konzept</strong></h2>

<div class="awareness-language-container">
    <div class="underline-rich-text-box no-word-break">
        <?php draw_language('deutsch'); ?>
        <br>
        <?php draw_language('englisch', 'english'); ?>
        <br>
        <?php draw_language('turkisch', 'türk'); ?>
    </div>
    <div class="underline-rich-text-box no-word-break">
        <?php draw_language('griechisch', 'Ελληνικά'); ?>
        <br>
        <?php draw_language('russisch', 'русский'); ?>
    </div>
</div>