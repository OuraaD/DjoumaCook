# Projet Symfony Marmytho

## Prérequis

-   PHP 8.2
-   Composer
-   Symfony CLI

## Installation

1. Cloner le projet :

```bash
git clone https://github.com/Edjek/symfony-marmytho
```

2. Se rendre dans le dossier du projet :

```bash
cd symfony-marmytho
```

3. Installer les dépendances :

```bash
composer install
```

4. Créer un fichier `.env.local` à la racine du projet et y ajouter les informations de connexion à la base de données

```env
DATABASE_URL="mysql://db_user:db_password@db_host:db_port/db_name"
```

5. Créer la base de données :

```bash
php bin/console doctrine:database:create
```

6. Générer le fichier de migration et lancer les migrations :

```bash
php bin/console make:migration

php bin/console doctrine:migrations:migrate
```

7. Lancer les fixtures :

```bash
php bin/console doctrine:fixtures:load
```

Un utilisateur admin est créé avec identifiant et mot de passe suivants :

-   admin@gmail.com
-   administrateur

Cet utilisateur a les droits d'administration sur le site. Une fois connecté, il peut acceder à la page d'administration en cliquant sur le bouton "Dashboard" dans le menu de navigation.

8. Lancer le serveur :

```bash
symfony serve -d
```

9. Se rendre sur http://localhost:8000

10. Enjoy !

---

[🏠 Retour au sommaire](#)

