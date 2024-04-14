# Use the specific version of MariaDB
FROM mariadb:latest

# Set environment variables for MySQL
ENV MYSQL_ROOT_PASSWORD=admin123
ENV MYSQL_DATABASE=employee_leaves
ENV MYSQL_USER=admin
ENV MYSQL_PASSWORD=admin123

# Copy your initialization scripts
COPY ./init.sql /docker-entrypoint-initdb.d/

# Copy the custom entrypoint script
COPY custom-entrypoint.sh /usr/local/bin/custom-entrypoint.sh
RUN chmod +x /usr/local/bin/custom-entrypoint.sh

# Expose the default port
EXPOSE 3306

# Set the custom entrypoint
ENTRYPOINT ["custom-entrypoint.sh"]
