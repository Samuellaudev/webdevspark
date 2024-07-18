<?php
$combined_data = [
	'attributes' => $attributes,
	'content' => $content
];
?>

<div class='HoverCardDemo block'>
	<pre id="hoverCardData" style='display: none'><?php echo esc_html(wp_json_encode($combined_data)); ?></pre>
</div>