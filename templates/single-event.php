<?php
/**
 * The Template for displaying all single events.
 *
 * Override this template by copying it to yourtheme/webs-events/single-event.php
 *
 * @author 	    Gabriel Gil
 * @package 	Webs Events/Templates
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'events' ); ?>

	<?php
		/**
		 * we_before_main_content hook
		 *
		 * @hooked we_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'we_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php we_get_template_part( 'content', 'single-event' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * we_after_main_content hook
		 *
		 * @hooked we_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'we_after_main_content' );
	?>
	
	<?php get_sidebar(); ?>

<?php get_footer( 'events' ); ?>