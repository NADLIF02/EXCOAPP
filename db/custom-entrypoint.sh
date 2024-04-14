#!/bin/bash
set -e

# Print out where mysqld and mysql_upgrade are located
which mysqld
which mysql_upgrade

# Rest of your script...
exec "/usr/local/bin/docker-entrypoint.sh" "$@"
