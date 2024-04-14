# Utiliser une image de base PHP avec Apache
FROM php:7.4-apache

# Installer les extensions PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Activer la réécriture d'URL pour Apache
RUN a2enmod rewrite

# Copier les fichiers sources dans le conteneur
COPY public/ /var/www/html/

# Exposer le port 80
EXPOSE 80
