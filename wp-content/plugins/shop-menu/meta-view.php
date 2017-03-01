<div>
	<dl>
		<dt>价格</dt>
		<dd>
			<?php $mb->the_field('price'); ?>
			<input type="text" name="<?php $mb->the_name(); ?>"
				value="<?php $mb->the_value(); ?>" style="text-align: right" />
		</dd>
		<dt>价格表示ShortCode</dt>
		<dd>
			<input type="text" value="[<?php echo sm::SHORTCODE_PRICE; ?>]" readonly/>
		</dd>
	</dl>
</div>
