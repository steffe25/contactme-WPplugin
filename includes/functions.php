<?php
function deliver_mail() {
    // If the submit button is clicked, send the email
    if (isset($_POST['cf-submitted'])) {
        
        // Sanitize form values
        $name    = sanitize_text_field($_POST["cf-name"]);
        $email   = sanitize_email($_POST["cf-email"]);
        $subject = sanitize_text_field($_POST["cf-subject"]);
        $message = esc_textarea($_POST["cf-message"]);
        
        // Get the blog administrator's email address
        $to = get_option('admin_email');
        
        $headers = array('Content-Type: text/html; charset=UTF-8', "From: $name <$email>");
        
        // If email has been process for sending, display a success message
        if (wp_mail($to, $subject, $message, $headers)) {
            echo '<div>';
            echo '<p>Thanks for contacting us, expect a response soon.</p>';
            echo '</div>';
        } else {
            echo 'An unexpected error occurred';
            
            // Log error to debug.log
            if (WP_DEBUG) {
                error_log('Contact form submission error: Email failed to send.');
            }
        }
    }
}
add_action('wp_head', 'deliver_mail');
