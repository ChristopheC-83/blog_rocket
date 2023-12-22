<h1>Projet Passerelle 2 : le Blog ! </h1>
<br><br>
<br><br>

<h3>19 & 20/12/23</h3>
Création de contenu <br>
Correction de bugs mineurs<br>
creation d'un fichier views/common/dont_forget_css.php pour inclure les fichiers css oubliés par purge_css car appelés seulement lors d'un affichage dynamique des données.<br>


<br>
<h3>18/12/23</h3>
Mise en place de ToolTip sur les icones sans texte.<br>

<br>
<h3>17/12/23</h3>
Slider en mode fade.<br>
Centrage images ajoutées dans le texte avec tinyMCE.<br>
Personnalisation su texte du header qq soit la page (à ma connaissance 😅).<br>
<br>

<br>
<h3>17/12/23</h3>
Possibilité ajout et modif video (seulement youtube testé)<br>
Possibilité ajout et modif texte pour chaque article.<br>
Comme texte sécurisé avant passage en DB, il faut le récupérer avec :<br>
html_entity_decode(htmlspecialchars_decode($article['text'])<br>
Ajout de commentaires par tous les utilisateurs connectés.<br>
Suppression commentaires par les administrateurs.<br>
Suppression des articles par Administrateurs.<br>

<br>
<h3>16/12/23</h3>
Possibilité ajout et modif image dans article<br>
Possibilité ajout et modif slider dans article<br>
Possibilité d'enlever le/mes média de l'article<br>

<br>
<h3>15/12/23</h3>
Possibilité MAJ cartes d'articles.<br>
Vérification de l'existence et du contenu lors de l'afficharge des articles d'un thème choisi.<br>
Qd on veut modifier ou compléter un article, on arrive sur le plus récent par défaut.<br>

<br>
<h3>14/12/23</h3>
couleurs au choix (menu déroulant) pour la création des themes<br>

<br>
<h3>13/12/23</h3>
creation contenu carte et envoi bdd.<br>
double controle de champs non vides pour la création d'un article (en js et en php).<br>
affichage cartes à l'accueil du site avec 1 couleur par theme<br>

<br>
<h3>12/12/23</h3>
Mise en place d'un loader le temps de l'envoi d'un nouveau mdp si oublié.<br>
Personnalisation des textes sur le header pour chacune des pages.<br>
La gestion des utilisateurs semblent achevées à ce niveau.<br>
Création des 1ers pointeurs pour la gestion des articles.<br>
Récupération des données brutes du formulaire.<br>

<br>
<h3>11/12/23</h3>
gestion utilisateurs<br>
Inscription, connexion, mot de passe oublié<br>
modif mail, mot de passe, suppression compte<br>
modification de l'avatar par un générique du site ou un perso<br>
Gestion utilisateurs et thèmes par administrateur<br>

<br>
<h3>10/12/23</h3>
Navbar faite pour le commencement.<br>
Footer, logos en place.<br>
MAJ couleurs BS :<br>
$primary: #A565CA <br>
$secondary: #0485f5 <br>
$dark: #050011 <br>
Mise en place de la DB (users, articles, themes, comments... pour le moment)<br>

<br>
<h3>9/12/23</h3>
Départ  de la mise en place de la structure MVC.<br>
MEP Boostrap (par npm, pas cdn afin de le personnaliser).<br>
Header accueil avec fond video (custom css, bootstrap non adapté)<br>
phrase font fam manuscrite qui se coupe à 660px au niveau de la virgule.<br>
Navbar ok sauf écran < 360px.<br>
Footer à changer par des liens (github, codepen, linkedin, barpat.fun).<br>

<br>
<h3>Objectifs : </h3>
Conception d'un blog.<br>
Technos : <br>
- php en POO sur un design pattern MVC.<br>
- CRUD appliqué aux articles.<br>
- style avec un Bootstrap personnalisé.<br>
- gestion des utilisateurs (inscription, connexion, commentaires, gestion administrateur).<br>
- 3 niveaux : Visiteurs / Utilisateurs / Admnistrateurs.<br>