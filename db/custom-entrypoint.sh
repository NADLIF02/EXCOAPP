#!/bin/bash
set -e

# Start the database server
docker-entrypoint.sh mysqld &

# Wait for the server to start (simple sleep for demo purposes, check for server readiness in production)
sleep 10

# Run mysql_upgrade
mysql_upgrade -u root -p"$MYSQL_ROOT_PASSWORD"

# Bring mysqld back to the foreground for Docker management
wait $!
