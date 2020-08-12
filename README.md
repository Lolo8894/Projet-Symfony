# LES CREATIONS DE LYLINE

## DESCRIPTION DU PROJET

Ce site internet permettra à une créatrice adepte de « Do It Yourself » qui
confectionne des vêtements et des accessoires avec de la laine, de se faire
connaître et de présenter ses oeuvres.

## INSTALLATION DU PROJET

Pour installer le projet, faire un clone du projet :

```
git clone https://github.com/Lolo8894/Projet-Symfony.git
```
Puis se placer dans le dossier :
```
cd Projet-Symfony
```

Puis penser à faire un `composer install` juste après en ligne de commande.

Si la base de données n'existe pas lancer la commande suivante :
```
php bin/console doctrine:database:create
```

Lancer ensuite la migration : 
```
php bin/console doctrine:migration:migrate
```

Vous débutez avec 2 utilisateurs : un administrateur et un simple utilisateur

## ASTUCES

- Les images se trouvent dans le dossier `public/images`
- Le CSS se trouve dans le dossier `public/css`