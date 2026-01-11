# 🚀 Guide de Déploiement VACILOC sur VPS

## Informations VPS
- **IP**: 72.62.180.169
- **Domaine**: www.vaciloc.com
- **OS**: Ubuntu 24.04 LTS
- **Localisation**: France - Paris

---

## 📋 Étape 1 : Connexion au VPS

```bash
ssh root@72.62.180.169
```

---

## 📦 Étape 2 : Installation des dépendances

```bash
# Mise à jour du système
sudo apt update && sudo apt upgrade -y

# Installation Apache, PHP 8.3 et MySQL
sudo apt install -y apache2 php8.3 php8.3-mysql php8.3-cli php8.3-common php8.3-curl php8.3-mbstring php8.3-xml php8.3-zip mysql-server

# Activation des modules Apache
sudo a2enmod rewrite
sudo a2enmod ssl

# Redémarrage Apache
sudo systemctl restart apache2
```

---

## 📁 Étape 3 : Upload des fichiers

### Option A : Via Git (Recommandé)
```bash
cd /var/www
sudo git clone https://github.com/David-delva/vaciloc.git vaciloc.com
```

### Option B : Via SCP depuis votre PC
```bash
# Depuis votre PC Windows (PowerShell)
scp -r C:\Users\user\Desktop\vaci_event_catalogue\3\* root@72.62.180.169:/var/www/vaciloc.com/
```

---

## 🗄️ Étape 4 : Configuration MySQL

```bash
# Se connecter à MySQL
sudo mysql -u root

# Exécuter les commandes SQL
CREATE DATABASE vaciloc_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'vaciloc_user'@'localhost' IDENTIFIED BY 'VotreMotDePasseSecurise123!';
GRANT ALL PRIVILEGES ON vaciloc_db.* TO 'vaciloc_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Importer la structure de la base
sudo mysql -u root vaciloc_db < /var/www/vaciloc.com/location.sql
```

---

## ⚙️ Étape 5 : Configuration du site

### 1. Modifier la configuration de la base de données
```bash
sudo nano /var/www/vaciloc.com/config/database.php
```

Modifiez les lignes suivantes :
```php
define('DB_PASS', 'VotreMotDePasseSecurise123!');
define('DEBUG_MODE', false);
```

### 2. Configurer Apache VirtualHost
```bash
# Copier la configuration
sudo cp /var/www/vaciloc.com/vaciloc.conf /etc/apache2/sites-available/

# Activer le site
sudo a2ensite vaciloc.conf

# Désactiver le site par défaut
sudo a2dissite 000-default.conf

# Tester la configuration
sudo apache2ctl configtest

# Redémarrer Apache
sudo systemctl restart apache2
```

### 3. Configurer les permissions
```bash
sudo chown -R www-data:www-data /var/www/vaciloc.com
sudo chmod -R 755 /var/www/vaciloc.com
sudo chmod -R 775 /var/www/vaciloc.com/public/images
```

---

## 🔒 Étape 6 : Installation SSL (HTTPS)

```bash
# Installer Certbot
sudo apt install -y certbot python3-certbot-apache

# Obtenir le certificat SSL
sudo certbot --apache -d vaciloc.com -d www.vaciloc.com

# Le renouvellement automatique est configuré par défaut
```

---

## 🌐 Étape 7 : Configuration DNS

Chez votre registrar de domaine (ex: OVH, Namecheap, etc.), ajoutez ces enregistrements DNS :

```
Type    Nom             Valeur              TTL
A       @               72.62.180.169       3600
A       www             72.62.180.169       3600
```

---

## ✅ Étape 8 : Vérification

1. **Tester le site** : https://www.vaciloc.com
2. **Tester l'admin** : https://www.vaciloc.com/admin
   - Username: `admin`
   - Password: `admin123` (à changer immédiatement !)

---

## 🔧 Commandes utiles

```bash
# Voir les logs Apache
sudo tail -f /var/log/apache2/vaciloc_error.log

# Redémarrer Apache
sudo systemctl restart apache2

# Vérifier le statut d'Apache
sudo systemctl status apache2

# Voir les logs MySQL
sudo tail -f /var/log/mysql/error.log

# Backup de la base de données
sudo mysqldump -u vaciloc_user -p vaciloc_db > backup_$(date +%Y%m%d).sql
```

---

## 🛡️ Sécurité Post-Déploiement

1. **Changer le mot de passe admin**
   ```sql
   UPDATE administrateurs SET mot_de_passe_hash = '$2y$10$...' WHERE nom_utilisateur = 'admin';
   ```

2. **Configurer le pare-feu**
   ```bash
   sudo ufw allow 80/tcp
   sudo ufw allow 443/tcp
   sudo ufw allow 22/tcp
   sudo ufw enable
   ```

3. **Supprimer le fichier test_db.php**
   ```bash
   sudo rm /var/www/vaciloc.com/public/test_db.php
   ```

---

## 📞 Support

En cas de problème :
- Vérifiez les logs : `/var/log/apache2/vaciloc_error.log`
- Vérifiez les permissions des fichiers
- Assurez-vous que MySQL est démarré : `sudo systemctl status mysql`

---

**Déploiement réalisé avec succès ! 🎉**
