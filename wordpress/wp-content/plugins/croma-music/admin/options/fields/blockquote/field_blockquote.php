<?php
class Redux_Options_blockquote {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
    	$id = $this->field['id'];
    	$quote_id = $this->field['id'].'-quote';
    	$author_id = $this->field['id'].'-author';
        $quote_name = $this->args['opt_name'] . '[' . $this->field['id'] . '][quote]';
        $author_name = $this->args['opt_name'] . '[' . $this->field['id'] . '][author]';

        $class = (isset($this->field['class'])) ? $this->field['class'] : 'large-text';
        $placeholder = (isset($this->field['placeholder'])) ? ' placeholder="' . esc_attr($this->field['placeholder']) . '" ' : '';
        $rows = (isset($this->field['placeholder'])) ? $this->field['rows'] : 6;
        ?>

		<div id="<?php echo esc_attr($this->field['id']) ?>" class="<?php echo esc_attr($class); ?>">
			<label><strong>Quote</strong></label>
	        <textarea name="<?php echo esc_attr($quote_name); ?>" id="<?php echo esc_attr($quote_id); ?>" <?php echo $placeholder; ?> class="<?php echo esc_attr($class); ?> <?php echo $class; ?>_quote" rows="<?php echo esc_attr($rows); ?>"><?php echo esc_attr($this->value['quote']); ?></textarea>

	        <label><strong>Author</strong></label>
	        <input name="<?php echo esc_attr($author_name); ?>" id="<?php echo esc_attr($author_id); ?>" type="text" <?php echo $placeholder ?> value="<?php echo esc_attr($this->value['author']); ?>" class="<?php echo esc_attr($class); ?> <?php echo $class ?>_author" />

	        <?php if( isset( $this->field['desc'] ) && $this->field['desc'] != '') : ?>
	            <br/><br><span class="description"><?php echo esc_attr($this->field['desc']); ?></span>
	        <?php endif; ?>
		</div>
        <?php
    }
}
