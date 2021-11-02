<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN TESTIMONIAL FORM                      |
 *  ##################################################
*/
?>

<form id="di-testimonial-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

	<div class="field-containter">
		<input type="text" class="field-input" placeholder="Your Name" id="name" name="name" required>
		<small class="field-msg error" data-error="name">Your Name is Required</small>
	</div>

	<div class="field-containter">
		<input type="email" class="field-input" placeholder="Your Email" id="email" name="email" required>
		<small class="field-msg error" data-error="email">Your Email is Required</small>
	</div>

	<div class="field-containter">
		<textarea name="message" id="message" class="form-field" placeholder="Your Message" required></textarea>
		<small class="field-msg error" data-error="message">A Message is Required</small>
	</div>
	
	<div class="text-center">
		<div>
            <button type="stubmit" class="btn btn-default btn-lg btn-testimonial-form">Submit</button>
        </div>
		<small class="field-msg js-form-submission">Submission in process, please wait&hellip;</small>
		<small class="field-msg success js-form-success">Message Successfully submitted, thank you!</small>
		<small class="field-msg error js-form-error">There was a problem with the Testimonial Form, please try again!</small>
	</div>

    <input type="hidden" name="action" value="submit_testimonial">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( "testimonial-nonce" ) ?>">

</form>