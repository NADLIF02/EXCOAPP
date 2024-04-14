# Utilisez une version spécifique de l'image officielle de MariaDB pour éviter des surprises avec 'latest'
FROM mariadb:latest

# Définissez des variables d'environnement pour le mot de passe root et les détails de la base de données
ENV MYSQL_ROOT_PASSWORD=admin123 \
    MYSQL_DATABASE=employee_leaves \
    MYSQL_USER=admin \
    MYSQL_PASSWORD=admin123

# Copiez votre fichier SQL dans le dossier d'initialisation de Docker
COPY ./db/init.sql /docker-entrypoint-initdb.d/
# Exposez le port par défaut de MariaDB
EXPOSE 3306

# Le script d'entrée par défaut de MariaDB s'occupera de lancer le serveur
CMD ["mysqld"]
