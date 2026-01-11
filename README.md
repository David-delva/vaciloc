# Application Web "Location" - Plateforme de Location de Matériel Événementiel

## Description

Application web complète développée en PHP avec architecture MVC pour la gestion des locations de matériel événementiel. La plateforme permet aux clients de parcourir un catalogue, effectuer des réservations et aux administrateurs de gérer les produits et réservations.

## Fonctionnalités

### Interface Publique
- **Page d'accueil** : Design moderne avec présentation des catégories et produits phares
- **Catalogue de produits** : Vue en grille avec filtrage par catégorie
- **Détail produit** : Images, description, sélecteur de quantité et calendrier de réservation
- **Panier de réservation** : Gestion des articles sélectionnés et formulaire de finalisation
- **Page de contact** : Formulaire de contact et informations de localisation

### Panneau d'Administration
- **Authentification sécurisée** : Connexion administrateur
- **Tableau de bord** : Statistiques et vue d'ensemble
- **Gestion des produits** : CRUD complet (Créer, Lire, Modifier, Supprimer)
- **Gestion des réservations** : Suivi et mise à jour des statuts
- **Gestion de l'inventaire** : Suivi automatique de la disponibilité

## Technologies Utilisées

- **Backend** : PHP 8+ (Orienté Objet)
- **Base de données** : MySQL 8+
- **Frontend** : HTML5, CSS3, JavaScript ES6+
- **Framework CSS** : Bootstrap 5.3
- **Architecture** : MVC (Modèle-Vue-Contrôleur)
- **Sécurité** : PDO avec requêtes préparées, validation des données, sessions sécurisées

## Structure du Projet

```
location/
├── config/
│   └── database.php          # Configuration base de données
├── lib/
│   ├── Database.php          # Classe de connexion PDO
│   └── Router.php            # Gestionnaire de routes
├── public/                   # Racine web
│   ├── css/
│   │   └── style.css         # Styles personnalisés
│   ├── js/
│   │   └── app.js            # JavaScript principal
│   ├── images/               # Images des produits
│   ├── .htaccess             # Configuration Apache
│   └── index.php             # Point d'entrée
├── src/
│   ├── controllers/          # Contrôleurs MVC
│   │   ├── AdminController.php
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   └── ReservationController.php
│   ├── models/               # Modèles de données
│   │   ├── Admin.php
│   │   ├── Category.php
│   │   ├── Client.php
│   │   ├── Product.php
│   │   └── Reservation.php
│   └── views/                # Vues (templates)
│       ├── admin/            # Interface d'administration
│       ├── layout/           # Layouts communs
│       └── public/           # Interface publique
├── location.sql              # Script de création BDD
└── README.md                 # Documentation
```

## Installation et Configuration

### Prérequis
- Serveur web Apache 2.4+
- PHP 8.0+ avec extensions PDO et MySQL
- MySQL 8.0+ ou MariaDB 10.4+
- Composer (optionnel)

### Étapes d'installation

1. **Cloner ou télécharger le projet**
   ```bash
   git clone [url-du-projet] location
   cd location
   ```

2. **Configuration du serveur web**
   - Pointer le DocumentRoot vers le dossier `public/`
   - Activer le module `mod_rewrite` d'Apache
   - Exemple de configuration Apache :
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/path/to/location/public"
       ServerName location.local
       <Directory "C:/path/to/location/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

3. **Création de la base de données**
   ```sql
   -- Se connecter à MySQL
   mysql -u root -p
   
   -- Importer le script SQL
   source location.sql
   ```

4. **Configuration de la base de données**
   - Modifier le fichier `config/database.php`
   - Ajuster les paramètres de connexion :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'Location');
   define('DB_USER', 'votre_utilisateur');
   define('DB_PASS', 'votre_mot_de_passe');
   ```

5. **Configuration des permissions**
   ```bash
   # Linux/Mac
   chmod 755 public/
   chmod 644 public/.htaccess
   chmod 755 public/images/
   
   # Windows - Donner les permissions d'écriture au dossier images
   ```

6. **Test de l'installation**
   - Accéder à `http://location.local` ou `http://localhost/location/public`
   - Vérifier que la page d'accueil s'affiche correctement

### Configuration de l'administration

1. **Connexion administrateur par défaut**
   - URL : `/admin`
   - Utilisateur : `admin`
   - Mot de passe : `admin123`

2. **Changer le mot de passe par défaut**
   - Se connecter au panneau d'administration
   - Modifier le mot de passe dans la base de données ou créer une interface de gestion

## Utilisation

### Interface Publique

1. **Navigation**
   - Parcourir le catalogue par catégorie
   - Consulter les détails des produits
   - Ajouter des articles au panier

2. **Réservation**
   - Sélectionner les dates de location
   - Remplir le formulaire client
   - Finaliser la demande de réservation

### Interface d'Administration

1. **Gestion des produits**
   - Ajouter de nouveaux produits
   - Modifier les informations et prix
   - Gérer les stocks

2. **Gestion des réservations**
   - Consulter les demandes
   - Modifier les statuts (En attente → Confirmée → Terminée)
   - Suivre les revenus

## Sécurité

### Mesures implémentées
- **Requêtes préparées PDO** : Protection contre l'injection SQL
- **Validation des données** : Filtrage et nettoyage des entrées utilisateur
- **Sessions sécurisées** : Gestion des sessions administrateur
- **Hachage des mots de passe** : Utilisation de `password_hash()`
- **Protection XSS** : Échappement des données avec `htmlspecialchars()`
- **Configuration Apache** : Restrictions d'accès aux fichiers sensibles

### Recommandations de production
- Utiliser HTTPS
- Configurer un firewall
- Mettre à jour régulièrement PHP et MySQL
- Sauvegarder régulièrement la base de données
- Monitorer les logs d'erreur

## Personnalisation

### Ajout de nouvelles catégories
```sql
INSERT INTO categories (nom) VALUES ('Nouvelle Catégorie');
```

### Modification des styles
- Éditer `public/css/style.css`
- Utiliser les variables CSS pour une cohérence visuelle

### Ajout de fonctionnalités
- Créer de nouveaux contrôleurs dans `src/controllers/`
- Ajouter les routes correspondantes dans `public/index.php`
- Créer les vues dans `src/views/`

## Dépannage

### Problèmes courants

1. **Erreur 500 - Internal Server Error**
   - Vérifier les permissions des fichiers
   - Contrôler la configuration Apache
   - Consulter les logs d'erreur

2. **Page blanche**
   - Activer l'affichage des erreurs PHP
   - Vérifier la connexion à la base de données

3. **Images non affichées**
   - Vérifier les permissions du dossier `public/images/`
   - S'assurer que les fichiers images existent

4. **Problème de routage**
   - Vérifier que `mod_rewrite` est activé
   - Contrôler le fichier `.htaccess`

### Logs et débogage
- Logs Apache : `/var/log/apache2/error.log` (Linux) ou `logs/error.log` (Windows)
- Logs PHP : Configurer `error_log` dans `php.ini`
- Logs application : Utiliser `error_log()` dans le code PHP

## Contact et Support

Pour toute question ou problème :
- **Téléphone** : +241 77 46 80 28
- **WhatsApp** : +241 77 46 80 28
- **Adresse** : Owendo, carrefour SNI, Libreville, Gabon

## Licence

Ce projet est développé pour la gestion de location de matériel événementiel. Tous droits réservés.

---

**Version** : 1.0.0  
**Dernière mise à jour** : <?= date('d/m/Y') ?>  
**Développé avec** : PHP, MySQL, Bootstrap 5