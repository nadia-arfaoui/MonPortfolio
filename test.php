<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Vérifier que les champs ne sont pas vides
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Veuillez remplir tous les champs correctement.";
        exit;
    }

    // Adresse de réception des e-mails
    $to = "nafiryounes@hotmail.com";  // Remplacez avec votre adresse e-mail
    $email_subject = "Nouveau message de: $name";
    $email_body = "Vous avez reçu un nouveau message.\n\n".
                  "Nom: $name\n".
                  "Email: $email\n".
                  "Sujet: $subject\n".
                  "Message:\n$message";

    // En-têtes de l'e-mail
    $headers = "From: $name <$email>";

    // Envoyer l'e-mail
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Succès
        echo "Votre message a été envoyé avec succès.";
    } else {
        // Échec
        echo "Une erreur est survenue, veuillez réessayer.";
    }
} else {
    // Si le formulaire n'est pas soumis correctement
    echo "Il y a un problème avec la soumission du formulaire, veuillez réessayer.";
}
?>
