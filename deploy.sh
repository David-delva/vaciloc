#!/bin/bash

# Script de déploiement VACILOC sur VPS
# Domaine: www.vaciloc.com
# IP: 72.62.180.169

echo "🚀 Déploiement de VACILOC sur VPS..."

# 1. Mise à jour du système
sudo apt update && sudo apt upgrade -y

# 2. Installation de Apache, PHP 8.3 et MySQL
sudo apt install -y apache2 php8.3 php8.3-mysql php8.3-cli php8.3-common php8.3-curl php8.3-mbstring php8.3-xml php8.3-zip mysql-server

# 3. Activation des modules Apache
sudo a2enmod rewrite
sudo a2enmod ssl

# 4. Création du répertoire du site
sudo mkdir -p /var/www/vaciloc.com

# 5. Configuration des permissions
sudo chown -R www-data:www-data /var/www/vaciloc.com
sudo chmod -R 755 /var/www/vaciloc.com

# 6. Redémarrage d'Apache
sudo systemctl restart apache2

echo "✅ Installation terminée !"
echo "📝 Prochaines étapes :"
echo "1. Uploadez les fichiers dans /var/www/vaciloc.com"
echo "2. Configurez la base de données MySQL"
echo "3. Configurez le VirtualHost Apache"
echo "4. Pointez votre domaine vers 72.62.180.169"
