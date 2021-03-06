<div class="options_group wc-products-selector">
	<div class="non-signup reminder hideable <?php do_action('fue_form_product_tr_class', $email); ?> product_tr">
		<p class="form-field">
			<label for="product_ids"><?php esc_html_e('Product', 'follow_up_emails'); ?></label>
			<?php
			$product_id     = (!empty($email->product_id)) ? $email->product_id : '';
			$product_name   = '';

			if ( !empty( $product_id ) ) {
				$product = WC_FUE_Compatibility::wc_get_product( $product_id );

				if ( $product ) {
					$product_name   = wp_kses_post( $product->get_formatted_name() );
				}
			}
			?>
			<input
				type="hidden"
				id="product_id"
				name="product_id"
				class="ajax_select2_products_and_variations"
				data-multiple="false"
				data-placeholder="<?php esc_attr_e('Search for a product&hellip;', 'follow_up_emails'); ?>"
				value="<?php echo esc_attr( $product_id ); ?>"
				data-selected="<?php echo esc_attr( $product_name ); ?>"
				data-allow_clear="true"
				data-nonce="<?php echo esc_attr( wp_create_nonce( 'update_email_template' ) ); ?>"
				>
		</p>

		<?php
		$display = 'display: none;';

		if ($has_variations)
			$display = 'display: inline-block;';
		?>
		<p class="form-field product_include_variations" style="<?php echo esc_attr( $display ); ?>">
			<input type="checkbox" name="meta[include_variations]" id="include_variations" value="yes" <?php if (isset($email->meta['include_variations']) && $email->meta['include_variations'] == 'yes') echo 'checked'; ?> data-nonce="<?php echo esc_attr( wp_create_nonce( 'update_email_template' ) ); ?>" />
			<label for="include_variations" class="inline"><?php esc_html_e('Include variations', 'follow_up_emails'); ?></label>
		</p>
	</div>

	<div class="non-signup reminder hideable <?php do_action('fue_form_category_tr_class', $email); ?> category_tr">
		<p class="form-field">
			<label for="category_id"><?php esc_html_e('Category', 'follow_up_emails'); ?></label>

			<select id="category_id" name="category_id" class="select2" data-placeholder="<?php esc_attr_e('Search for a category&hellip;', 'follow_up_emails'); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'update_email_template' ) ); ?>" style="min-width:155px;">
				<option value="0"><?php esc_html_e('Any Category', 'follow_up_emails'); ?></option>
				<?php
				foreach ($categories as $category):
					?>
					<option value="<?php esc_attr_e($category->term_id); ?>" <?php selected( $email->category_id, $category->term_id ); ?>><?php echo esc_html($category->name); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
	</div>
</div>
