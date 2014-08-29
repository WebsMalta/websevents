<?php
/**
 * The template for displaying event content in the single-event.php template
 *
 * Override this template by copying it to yourtheme/webs-event/content-single-event.php
 *
 * @author 		Gabriel Gil
 * @package 	WebsEvents/Templates
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * we_before_single_event hook
	 *
	 * @hooked we_print_notices - 10
	 */
	 do_action( 'we_before_single_event' );

	 if ( post_password_required() ) {
	 	// echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo we_get_event_schema(); ?>" id="event-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * we_before_single_event_summary hook
		 *
		 * @hooked we_show_event_gallery - 20
		 */
		do_action( 'we_before_single_event_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * we_single_event_summary hook
			 *
			 * @hooked we_template_single_title - 5
			 * @hooked we_template_single_happening_date - 10
			 * @hooked we_template_single_excerpt - 20
			 * @hooked we_template_single_meta - 30
			 * @hooked we_template_single_sharing - 40
			 */
			do_action( 'we_single_event_summary' );
		?>

	</div><!-- .summary -->

	<?php
		/**
		 * we_after_single_event_summary hook
		 *
		 * @hooked we_output_event_data_tabs - 10
		 * @hooked we_upsell_display - 15
		 * @hooked we_output_related_events - 20
		 */
		do_action( 'we_after_single_event_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #event-<?php the_ID(); ?> -->

<?php do_action( 'we_after_single_event' ); ?>
