<?php
/*
Plugin Name: contactme
Description: A simple contact form plugin.
Version: 1.0
Author: Sampo Malinen
*/

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/functions.php';

// Enqueue styles
function my_contact_form_styles() {
    wp_enqueue_style('my-contact-form-styles', plugins_url('assets/css/style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'my_contact_form_styles');

// Add the shortcode
function my_contact_form() {
    $form = '
    <form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">
        <p>
            Nimi <br/>
            <input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . (isset($_POST["cf-name"]) ? esc_attr($_POST["cf-name"]) : '') . '" size="40" />
        </p>
        <p>
            Sähköposti <br/>
            <input type="email" name="cf-email" value="' . (isset($_POST["cf-email"]) ? esc_attr($_POST["cf-email"]) : '') . '" size="40" />
        </p>
        <p>
            Otsikko <br/>
            <input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . (isset($_POST["cf-subject"]) ? esc_attr($_POST["cf-subject"]) : '') . '" size="40" />
        </p>
        <p>
            Kuinka voin auttaa? <br/>
            <textarea rows="10" cols="35" name="cf-message">' . (isset($_POST["cf-message"]) ? esc_attr($_POST["cf-message"]) : '') . '</textarea>
        </p>
        <p><input type="submit" name="cf-submitted" value="Lähetä"></p>
    </form>
    ';
    return $form;
}
add_shortcode('my_contact_form', 'my_contact_form');