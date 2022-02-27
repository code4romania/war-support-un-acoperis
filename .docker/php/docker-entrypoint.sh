#!/bin/sh
set -e
## make sure all files are created with group write permission
umask 0002

exec "$@"
