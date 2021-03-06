<?php if ( $unsubscribed ): ?>
	<div class="woocommerce-message"><?php esc_html_e('Successfully unsubscribed from the selected email', 'follow_up_emails'); ?></div>
<?php
endif;

if ( $emails ):
	$ref_url = get_permalink( get_the_ID() );
?>
<table class="shop_table my_accout_emails">
	<thead>
		<tr>
			<th class="order-number"><span class="nobr"><?php esc_html_e('Order', 'follow_up_emails'); ?></span></th>
			<th class="actions"><span class="nobr"><?php esc_html_e('Actions', 'follow_up_emails'); ?></span></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ( $emails as $email ):
			$order = WC_FUE_Compatibility::wc_get_order($email->order_id);

			// Handle non-existing orders
			if ( ! is_a( $order, 'WC_Order' ) ) {
				continue;
			}

			if ( function_exists( 'wc_get_endpoint_url' ) ) {
				$order_url = wc_get_endpoint_url( 'view-order', $email->order_id, wc_get_page_permalink( 'myaccount' ) );
			} else {
				$order_url = add_query_arg('order', $email->order_id, get_permalink( wc_get_page_id( 'view_order' ) ) );
			}
		?>
		<tr>
			<td class="order-number">
				<a href="<?php echo esc_url( $order_url ); ?>">
					<?php echo esc_html( $order->get_order_number() ); ?></a>
					&ndash;
				<em>(<?php echo esc_html( sprintf( _n('1 email', '%d emails', $email->num, 'follow_up_emails'), $email->num ) ); ?>)</em>
			</td>
			<td><a href="<?php echo esc_url( wp_nonce_url(add_query_arg(array('fue_action' => 'order_unsubscribe', 'email' => $email->user_email, 'order_id' => $email->order_id, 'ref' => rawurlencode( $ref_url ) ) ), 'fue_unsubscribe') ); ?>" class="button"><?php esc_html_e('Unsubscribe', 'follow_up_emails'); ?></a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<div class="woocommerce-info">
	<a href="<?php echo esc_url( get_permalink( wc_get_page_id('myaccount') ) ); ?>" class="button"><?php esc_html_e('Back to My Account', 'follow_up_emails'); ?></a>
	<?php esc_html_e('You are not subscribed to any emails.', 'follow_up_emails'); ?>
</div>
<?php endif; ?>
