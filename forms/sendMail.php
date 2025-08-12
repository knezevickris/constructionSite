<?php
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    function sanitize($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    $ime    = sanitize($_POST['name'] ?? '');
    $email  = sanitize($_POST['email'] ?? '');
    $brojTelefona = sanitize($_POST['phone'] ?? '');
    $poruka = sanitize($_POST['message'] ?? '');

    if (!$ime || !$email || !$poruka || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Greška: Neispravan unos.";
        exit;
    }


    $mejl = new PHPMailer(true);

    try{
        $mejl->isSMTP();
        $mejl->Host = 'smtp.gmail.com';
        $mejl->SMTPAuth = true;
        $mejl->Username = 'testnigradjevinac@gmail.com';
        $mejl->Password = 'quxi xwxw liby szdz';
        $mejl->SMTPSecure = 'tls';
        $mejl->Port = 587;

        $mejl->setFrom('testnigradjevinac@gmail.com', 'website VB Inzenjeringa');
        $mejl->addAddress('kristinaknezevic06@gmail.com', 'Kontakt');

        $mejl->isHTML();
        $mejl->Subject = 'Nova poruka sa kontakt forme sajta';
        $mejl->Body = '<h3>Nova poruka sa sajta</h3>
        <p><strong>Ime:</strong> ' . $ime . '</p>
        <p><strong>Email:</strong> ' . $email . '</p>
        <p><strong>Broj telefona:</strong> ' . $brojTelefona . '</p>
        <p><strong>Poruka:</strong><br>' . nl2br($poruka) . '</p>';

        $mejl->send();

        echo  '<div class="sent-message">Poruka je uspešno poslata! Hvala na interesovanju.</div>';
        echo '<script>
                document.querySelector("form").reset();
              </script>';

    }
    catch (Exception $e){
        echo '<div class="error-message">Greška! Popunite sva polja i pokušajte ponovo.</div>';
        echo "Greška pri slanju: {$mejl->ErrorInfo}";
}