<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :
		
		do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>
    
        <div class="woocommerce-order-over">

		<?php if ( $order->has_status( 'failed' ) || $order->has_status("epayco-failed") ) : ?>

            <h1 class="order-result subtitle is-size-2"><i class="bb-icons bb-icon-close-circle"></i>Tu pedido ha fallado</h1>
			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'buddyboss-theme' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'buddyboss-theme' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'buddyboss-theme' ); ?></a>
				<?php endif; ?>
			</p>
        <?php elseif( $order->has_status( 'epayco-on-hold' )) : ?>
            <h1 class="order-result subtitle is-size-2"><i class="bb-icons bb-icon-alert-octagon"></i>Tu pedido está Pendiente</h1>
            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">Tu pedido está en esta Pendiente hasta recibir confirmación con tu banco. Esto puede suceder por diferentes razones de validación. Te confirmaremos cuando el pago haya sido confirmado.</p>
           

		<?php else : ?>
            <?php 
                $current_user = wp_get_current_user();
                $mycourses_link = (function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( $current_user->ID ) : get_author_posts_url( $current_user->ID ))."cursos";
                ?> 
                <h1 class="order-result subtitle is-size-2 has-small-padding-top"><i class="bb-icons bb-icon-check-circle"></i><?php _e( 'Your Order Confirmed', 'buddyboss-theme' ); ?></h1>

                <?php 
                $items = $order->get_items();
                ?>

                
    
    			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
    
    				<li class="woocommerce-order-overview__order order">
    					<?php esc_html_e( 'Order number:', 'buddyboss-theme' ); ?>
    					<span><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
    				</li>
    
    				<li class="woocommerce-order-overview__date date">
    					<?php esc_html_e( 'Date:', 'buddyboss-theme' ); ?>
    					<span><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
    				</li>
    
    				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
    					<li class="woocommerce-order-overview__email email">
    						<?php esc_html_e( 'Email:', 'buddyboss-theme' ); ?>
    						<span><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
    					</li>
    				<?php endif; ?>
    
    				<li class="woocommerce-order-overview__total total">
    					<?php esc_html_e( 'Total:', 'buddyboss-theme' ); ?>
    					<span><?php echo $order->get_formatted_order_total()." ".$order->get_currency(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
    				</li>
    
    				<?php if ( $order->get_payment_method_title() ) : ?>
    					<li class="woocommerce-order-overview__payment-method method">
    						<?php esc_html_e( 'Payment method:', 'buddyboss-theme' ); ?>
    						<span><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
    					</li>
    				<?php endif; ?>
    
    			</ul>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
        </div> <?php // woocommerce-order-over ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'buddyboss-theme' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>

<div class="woocommerce-order-end">
    <h3 class="woocommerce-heading--end"><?php _e( 'Thank you for shopping with us!', 'buddyboss-theme' ); ?></h3>
    <p class="woocommerce-notice-end"><?php _e( "We'll be sending a confirmation email when the order is processed.", 'buddyboss-theme' ); ?></p>
</div>