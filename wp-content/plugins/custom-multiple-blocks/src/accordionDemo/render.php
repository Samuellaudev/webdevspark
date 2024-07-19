<?php
$combined_data = [
	'attributes' => $attributes,
	'content' => $content
];
?>

<div class='AccordionDemo custom-multiple-blocks'>
	<pre id="accordionData" style='display: none'><?php echo esc_html(wp_json_encode($combined_data)); ?></pre>
</div>