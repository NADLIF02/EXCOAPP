# Use a specific version of MariaDB
FROM mariadb:10.5

# Set environment variables for database configuration
ENV MYSQL_ROOT_PASSWORD=admin123
ENV MYSQL_DATABASE=employee_leaves
ENV MYSQL_USER=admin
ENV MYSQL_PASSWORD=admin123

# Copy your initialization scripts
COPY ./init.sql /docker-entrypoint-initdb.d/

# Copy the custom entrypoint script and ensure it is executable
COPY custom-entrypoint.sh /usr/local/bin/custom-entrypoint.sh
RUN chmod +x /usr/local/bin/custom-entrypoint.sh

# Expose the default database port
EXPOSE 3306

# Use the custom entrypoint script
ENTRYPOINT ["custom-entrypoint.sh"]

# By default, start the MariaDB server
CMD ["mysqld"]
