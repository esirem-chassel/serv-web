# Téléchargement

Téléchargez le ZIP du dépôt (branche `test`) en local sur votre poste.

> [!Caution]
> Soyez sûr de bien être sur la branche test !

Décompressez le ZIP en local. Puis, via SCP, envoyez le contenu du dossier `casino` dans votre dossier Web de nginx.

# Installation

## Base de données

Créez un fichier `.dbpath` à la racine du site.
Dans ce fichier, indiquez le chemin vers votre base de données, au format `.json`.
Exemple : si vous souhaitez stocker votre base dans un dossier `<chemin application>/db/store.json`, indiquez `db/store`.

> [!Caution]
> Le script ne crée pas les dossiers nécessaires, c'est à vous de le faire !

## APIKEY

Pour des besoins futurs, vous devez enregistrer une clef API via la ligne de commande.
