# Utiliser une image de base PHP avec Apache
FROM php:8.0-apache

# Mettre à jour les paquets et installer les dépendances nécessaires, y compris MySQL Client
RUN apt-get update && \
    apt-get install --yes --force-yes cron g++ gettext libicu-dev openssl libc-client-dev libkrb5-dev libxml2-dev libfreetype6-dev libgd-dev libmcrypt-dev bzip2 libbz2-dev libtidy-dev libcurl4-openssl-dev libz-dev libmemcached-dev libxslt-dev default-mysql-client

# Activer la réécriture d'URL pour Apache, permettant l'utilisation de .htaccess pour des URL amicales
RUN a2enmod rewrite

# Activer le module headers pour Apache, utile pour modifier les en-têtes HTTP dans vos réponses
RUN a2enmod headers

# Copier les fichiers du projet dans le conteneur
# Assurez-vous que les dossiers 'src' et 'public' contiennent les fichiers nécessaires à votre application
# COPY src/ /var/www/src/
# COPY public/ /var/www/html/

# Changer la propriété des fichiers au www-data utilisateur et groupe pour éviter les problèmes de permission
RUN chown -R www-data:www-data /var/www

# Exposer le port 80 pour permettre l'accès via un navigateur web
EXPOSE 80

# Le point d'entrée par défaut lance Apache en mode foreground
CMD ["apache2-foreground"]
