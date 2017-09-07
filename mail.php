<?php
/* Set e-mail recipient */
$myemail = "ivancice@net.hr";

/* Check all form inputs using check_input function */
$name = check_input($_POST['name'], "Upišite vaše ime");
$subject = check_input($_POST['subject'], "Unesite naslov");
$email = check_input($_POST['email']);
$message = check_input($_POST['message'], "Upišite vašu poruku");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
show_error("E-mail nije valjan");
}
/* Let's prepare the message for the e-mail */
$message = "

Name: $name
E-mail: $email
Subject: $subject

Message:
$message

";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: hvala.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
if ($problem && strlen($data) == 0)
{
show_error($problem);
}
return $data;
}

function show_error($myError)
{
?>
<html>
<body>

<p>Molimo vas da ispravite grešku:</p>
<strong><?php echo $myError; ?></strong>
<p>Stisnite gumb za povratak i pokušajte ponovo.</p>

</body>
</html>
<?php
exit();
}
?>