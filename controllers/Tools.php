<?php
class Tools
{

    public static function alertMessage($message, $type)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type." mt-5 mb-3 text-center"
        ];
    }

    // affichage lisible de données en tableau
    public static function showArray($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    // sécurisation des données reçues avant traitement
    public static function secureHTML($string)
    {
        return htmlentities($string);
    }
    //  vérifie si l'utilisateur est connecté
    public static function isConnected()
    {
        return (!empty($_SESSION['profile']['role']));
    }
    //  vérifie si l'utilisateur est connecté et est au moins utilisateur
    public static function isUser()
    {
        return ($_SESSION['profile']['role'] === "user" ||
            $_SESSION['profile']['role'] === "admin"
        );
    }

    //  vérifie si l'utilisateur est connecté et est administrateur
    public static function isAdministrator()
    {
        return ($_SESSION['profile']['role'] === "admin");
    }
    // fonction d'envoi d'un mail
    public static function sendMail($to, $subject, $message)
    {
        $headers = "From : christophe@barpat.fun";
        if (mail($to, $subject, $message, $headers)) {
            Tools::alertMessage("Mail envoyé.", "alert-success");
        } else {
            Tools::alertMessage("Mail non envoyé.", "alert-danger");
        }
    }
    // nom détourné pour la crétion d'un cookie pour sécuriser la connexion
    public const COOKIE_NAME = "memory";

    //  création d'un cookie valide 24h
    public static function  generateCookieConnection()
    {
        $ticket = session_id() . microtime() . rand(0, 999999);
        $ticket = hash("sha512", $ticket);
        setCookie(self::COOKIE_NAME, $ticket, time() + (60 * 60 * 24));
        $_SESSION['profile'][self::COOKIE_NAME] = $ticket;
    }
    //  compare le cookie sur la machine au cookie généré
    // sécurise la connexion
    public static function  checkCookieConnection()
    {
        return $_COOKIE[self::COOKIE_NAME] === $_SESSION['profile'][self::COOKIE_NAME];
    }
    // action si le cookie n'est pas vérifié
    public static function  badCookie()
    {
        Tools::alertMessage("Veuillez vous reconnecter.", "alert-warning");
        setcookie(Tools::COOKIE_NAME, "", time() - 3600);
        unset($_SESSION['profile']);
        header('Location: ' . URL . 'connection');
    }
}
