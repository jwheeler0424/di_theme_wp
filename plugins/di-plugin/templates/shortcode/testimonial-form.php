<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN TESTIMONIAL FORM                      |
 *  ##################################################
*/
?>

<form id="di-testimonial-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

    <fieldset>
        <label for="company">Company Name <span>(Optional)</span></label>
		<input type="text" class="field-input" placeholder="Company, Inc." id="company" name="company">
	</fieldset>

	<fieldset data-error="name">
        <label for="name">Full Name</label>
		<input type="text" class="field-input" placeholder="John Smith" id="name" name="name" required>
		<small class="field-msg">Your Full Name is Required</small>
	</fieldset>

    <fieldset data-error="email">
        <label for="email">Email Address</label>
		<input type="email" class="field-input" placeholder="yourname@website.com" id="email" name="email" required>
		<small class="field-msg">Your Email is Required</small>
	</fieldset>

	<fieldset data-error="message">
        <label for="message">Message</label>
		<textarea name="message" id="message" class="form-field" placeholder="Tell us about your experience..." required></textarea>
		<small class="field-msg">A Message is Required</small>
	</fieldset>
	
	<fieldset>
		<button type="submit" class="btn btn-submit">Submit</button>
        <small class="field-msg js-form-submission">Submission in process, please wait&hellip;</small>
        <input type="hidden" name="action" value="submit_testimonial">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( "testimonial-nonce" ) ?>">
	</div>

</form>