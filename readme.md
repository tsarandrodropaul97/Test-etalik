# - I - Application Web de Formulaires Dynamiques

## 1-Description

Cette application web permet aux utilisateurs de créer des formulaires dynamiques avec différents types de champs (texte, nombre, date, etc.) et d'afficher les réponses soumises pour chaque formulaire. Développée avec Symfony 7, Doctrine ORM, Twig, et Bootstrap, elle offre une interface utilisateur intuitive et réactive.

## 2- Table des matières

- [Fonctionnalités]
- [Technologies]
- [Prérequis]
- [Installation]
- [Utilisation]

## 3- Fonctionnalités

- Créer des formulaires dynamiques avec différents types de champs.
- Afficher chaque formulaire créé dans une page dédiée.
- Lister toutes les réponses soumises pour chaque formulaire dans un tableau.
- Interface utilisateur responsive avec Bootstrap.

## 4- Technologies

- Symfony 7
- Doctrine ORM
- Twig
- Bootstrap
- PHP 8.3
- MariaDB

## 5- Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- PHP 8.2 ou supérieur
- Composer
- MariaDB

## 6- Installation

1. **Clonez le dépôt :**

   ```bash
    git clone https://github.com/tsarandrodropaul97/Test-etalik.git
    cd Test-etalik
    composer install

    Une fois que l'installation de Composer est terminée, assurez-vous d'avoir une connexion Internet pour que le projet fonctionne parfaitement, car il utilise des CDN pour les DataTables.

 ## 7- Utilisation
    Avant de lancer ce projet, assurez-vous de lancer le fichier input.sql dans votre base de données pour le remplir avec des données prédéfinies à propos des types de formulaires.

    Une fois, que ce fait, il suffit juste de lancer ce projet avec "symfony serve" ou "php -S localhos:8000 -t public" 

  Dans le menu Création du formulaire :
    - On doit créer les attributs avec leur type (exemple : Nom de type Texte).
    - Après avoir créé un formulaire, il affiche la liste de tous les formulaires sur une autre     page, où vous pouvez choisir celui que vous voulez. Ensuite, vous devez mettre une valeur pour chaque formulaire que vous avez créé. Sur la liste des attributs, il y a un crochet qui montre l'effectif de valeurs assignées pour le formulaire.
    -Après cela, dès que le formulaire a une valeur, il affiche toutes les informations complètes concernant le formulaire dans un tableau sur la page d'accueil.