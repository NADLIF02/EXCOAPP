# Use the specific version of MariaDB
FROM mariadb:11.2

# Set environment variables for MySQL
ENV MYSQL_ROOT_PASSWORD=admin123
ENV MYSQL_DATABASE=employee_leaves
ENV MYSQL_USER=admin
ENV MYSQL_PASSWORD=admin123

# Copy your initialization scripts
COPY ./init.sql /docker-entrypoint-initdb.d/

# Set the custom entrypoint, if you have one
COPY custom-entrypoint.sh /usr/local/bin/custom-entrypoint.sh
RUN chmod +x /usr/local/bin/custom-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose the default port
EXPOSE 3306

# If using a custom entrypoint, ensure it executes the main process
# ENTRYPOINT ["custom-entrypoint.sh"]
CMD ["mysqld"]
