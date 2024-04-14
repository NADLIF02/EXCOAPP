# Utiliser une image de base PHP avec Apache
FROM php:7.4-apache

# Installer les extensions PDO et MySQLi pour la connexion à la base de données
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Activer la réécriture d'URL pour Apache, permettant l'utilisation de .htaccess pour des URL amicales
RUN a2enmod rewrite

# Activer le module headers pour Apache, utile pour modifier les en-têtes HTTP dans vos réponses
RUN a2enmod headers

# Copier les fichiers du projet dans le conteneur
# Assurez-vous que les dossiers 'src' et 'public' contiennent les fichiers nécessaires à votre application
COPY src/ /var/www/src/
COPY public/ /var/www/html/

# Changer la propriété des fichiers au www-data utilisateur et groupe pour éviter les problèmes de permission
RUN chown -R www-data:www-data /var/www

# Exposer le port 80 pour permettre l'accès via un navigateur web
EXPOSE 80

# Le point d'entrée par défaut lance Apache en mode foreground
CMD ["apache2-foreground"]
