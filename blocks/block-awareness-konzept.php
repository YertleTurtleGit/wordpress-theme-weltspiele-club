<?php
if( !function_exists( 'draw_language' )) {
	function draw_language($name, $echo_name = null): void
	{
		if ($echo_name == null) {
			$echo_name = $name;
		}

		if (block_value($name)) {
			echo "<a href='" . wp_get_attachment_url(block_value($name)) . "' target='blank'>" . $echo_name . "</a>";
		}
	}
}
?>

<h2 style="padding-top: 3rem;"><strong>Awareness Konzept</strong></h2>

<div class="awareness-language-container uppercase">
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