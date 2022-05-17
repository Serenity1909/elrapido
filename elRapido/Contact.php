<?php
session_start();

require_once 'ReUsedCode/config.php';

$title ='Contact / Support';
require 'ReUsedCode/header.php';

require 'ReUsedCode/login.php';
?>

<!-- Contact form -->
<section>
    <form method="POST" id="containerContact">
        <label>Your pseudo :</label>
        <input type="text" name="pseudo" placeholder="Your pseudo" />

        <label>Your email :</label>
        <input type="text" name="email" placeholder="Your email" />

        <label>Your message :</label>
        <textarea name="message" cols="83" rows="10" placeholder="Work in Progress, don't send your message yet :D"></textarea>

        <button class="btn" type="submit" name="mailform">Submit</button>

        <p style="float:right;"><a href="Contact.php">Cancel</a></p>
    </form>
</section>

<?php
require 'ReUsedCode/footer.php';
?>