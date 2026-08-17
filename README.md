# Green Goodies

Site e-commerce développé avec Symfony, incluant une API REST sécurisée par JWT.

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Symfony CLI
- PostgreSQL
- Extension PHP `sodium` activée
- Extension PHP `openssl` activée

## Installation

### 1. Cloner le projet

```bash
git clone <url-du-depot>
cd GreenGoodies
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer les variables d'environnement

Copier le fichier `.env` en `.env.local` et adapter les valeurs :

Renseigner notamment :

```
DATABASE_URL="postgresql://postgres:password@127.0.0.1:5432/greengoodies?serverVersion=18&charset=utf8"
```

### 4. Créer la base de données et exécuter les migrations

```bash
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
```

### 5. Charger les fixtures (fixtures pour les articles)

```bash
symfony console doctrine:fixtures:load
```

### 6. Lancer le serveur

```bash
symfony server:start
```

Le site est alors accessible sur `http://127.0.0.1:8000`.


### Documentation API (Nelmio)

La documentation de l'API est accessible à l'adresse :
http://127.0.0.1:8000/api/doc

