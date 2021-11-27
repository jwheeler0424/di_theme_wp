<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN CONTACT MESSAGE FORM                  |
 *  ##################################################
*/
?>

<form id="di-contact-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

    <fieldset data-error="subject">
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
		
		<small class="field-msg">A Contact Reason is Required</small>
    </fieldset>

	<fieldset>
        <label for="company">Company Name <span>(Optional)</span></label>
		<input type="text" class="field-input" placeholder="Company, Inc." id="company" name="company">
	</fieldset>

	<fieldset data-error="first">
        <label for="first">First Name</label>
		<input type="text" class="field-input" placeholder="John" id="first" name="first" required>
		<small class="field-msg">Your First Name is Required</small>
	</fieldset>

	<fieldset data-error="last">
        <label for="last">Last Name</label>
		<input type="text" class="field-input" placeholder="Doe" id="last" name="last" required>
		<small class="field-msg">Your Last Name is Required</small>
	</fieldset>

	<fieldset data-error="email">
        <label for="email">Email Address</label>
		<input type="email" class="field-input" placeholder="yourname@website.com" id="email" name="email" required>
		<small class="field-msg">Your Email is Required</small>
	</fieldset>

    <fieldset data-error="phone">
        <label for="phone">Phone Number</label>
		<input type="phone" class="field-input" placeholder="(555) 555-5555" id="phone" name="phone" required>
		<small class="field-msg">Your Phone Number is Required</small>
	</fieldset>

	<fieldset data-error="message">
        <label for="message">Message</label>
		<textarea name="message" id="message" class="form-field" placeholder="Tell us what you would like to talk about..." required></textarea>
		<small class="field-msg">A Message is Required</small>
	</fieldset>
	
	<fieldset>
		<div>
            <button type="submit" class="btn btn-submit">Submit</button>
        </div>
		<small class="field-msg js-form-submission">Submission in process, please wait&hellip;</small>
		<small class="field-msg js-form-success">Message Successfully submitted, thank you!</small>
		<small class="field-msg js-form-error">There was a problem with the Contact Form, please try again!</small>
	</fieldset>

    <input type="hidden" name="action" value="submit_contact">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( "contact-nonce" ) ?>">

</form>