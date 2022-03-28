<?php
/**
 * Template part for displaying modal search
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SacchaOne
 */

?>
<div class="search-modal modal fade" id="search-modal" tabindex="-1" aria-labelledby="search-modal-title" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body container">
			<?php
			get_search_form(
				array(
					'location' => 'navbar',
				)
			);
			?>
			<button type="button" class="btn btn-outline-primary saccha-btn-close" data-dismiss="modal" aria-label="Close">
				<span class="fa fa-close"></span>
			</button>
			</div>
		</div>
	</div>
</div>