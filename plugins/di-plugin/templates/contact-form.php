<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN CONTACT MESSAGE FORM                  |
 *  ##################################################
*/
?>

<form id="di-contact-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

    <div class="field-containter">
        <label>Contact Reason</label>
        <select class="field-input" id="subject" name="subject" data-custom required>
            <option class="placeholder hidden" value="" disabled selected hidden>Select a reason...</option>
            <option value="General Inquiry">General Inquiry</option>
            <option value="Get Quote">Get Quote</option>
            <option value="Network Setup">Network Setup</option>
            <option value="Computer Diagnostic">Computer Diagnostic</option>
            <option value="Computer Upgrades">Computer Upgrades</option>
            <option value="File Backup & Migration">File Backup & Migration</option>
            <option value="Virus Scan / Cleanup">Virus Scan / Cleanup</option>
            <option value="New Website">New Website</option>
            <option value="Existing Website">Existing Website</option>
            <option value="Logo Design">Logo Design</option>
            <option value="UI/UX Design">UI/UX Design</option>
            <option value="Windows 11 Upgrade">Windows 11 Upgrade</option>
        </select>
		
		<small class="field-msg error" data-error="subject">A Contact Reason is Required</small>
	</div>

	<!-- <div class="field-containter">
		<input type="text" class="field-input" placeholder="Your Name" id="name" name="name" required>
		<small class="field-msg error" data-error="name">Your Name is Required</small>
	</div>

	<div class="field-containter">
		<input type="text" class="field-input" placeholder="Company Name" id="company" name="company">
		<small class="field-msg error" data-error="company">Your Name is Required</small>
	</div>

	<div class="field-containter">
		<input type="email" class="field-input" placeholder="Your Email" id="email" name="email" required>
		<small class="field-msg error" data-error="email">Your Email is Required</small>
	</div>

    <div class="field-containter">
		<input type="phone" class="field-input" placeholder="Your Phone" id="phone" name="phone" required>
		<small class="field-msg error" data-error="phone">Your Phone Number is Required</small>
	</div>

	<div class="field-containter">
		<textarea name="message" id="message" class="form-field" placeholder="Your Message" required></textarea>
		<small class="field-msg error" data-error="message">A Message is Required</small>
	</div>
	
	<div class="text-center">
		<div>
            <button type="stubmit" class="btn btn-default btn-lg btn-contact-form">Submit</button>
        </div>
		<small class="field-msg js-form-submission">Submission in process, please wait&hellip;</small>
		<small class="field-msg success js-form-success">Message Successfully submitted, thank you!</small>
		<small class="field-msg error js-form-error">There was a problem with the Contact Form, please try again!</small>
	</div>

    <input type="hidden" name="action" value="submit_contact">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( "contact-nonce" ) ?>"> -->

</form>