<?php
$combined_data = [
	'attributes' => $attributes,
	'content' => $content
];
?>

<div class='NavigationMenuDemo custom-multiple-blocks'>
	<pre id="navigationMenuData" style='display: none'><?php echo esc_html(wp_json_encode($combined_data)); ?></pre>
</div>