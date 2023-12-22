<?php
class Tools
{

    //  les alertes sont de texte libre et de couleurs gérées par bootstrap
    // elles sont affichées dans le template, donc sur toutes les pages au besoin.
    public static function alertMessage($message, $type)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type . " mt-5 mb-3 text-center fw-bold",
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
    //  vérifie si l'utilisateur est connecté et est administrateur
    public static function isAdministrator()
    {
        return ($_SESSION['profile']['role'] === "admin");
    }
    // fonction d'envoi d'un mail
    public static function sendMail($to, $subject, $message)
    {
        $headers = "From: christophe@barpat.fun";
        if (!mail($to, $subject, $message, $headers)) {
            Tools::alertMessage("Mail non envoyé.", "alert-danger");
        }
    }
}
