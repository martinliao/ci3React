#!/bin/bash

#set -ex
echo "Current user: [`whoami`], Current dir: [`pwd`]..."
#echo "PHPVERSION=${PHPVERSION}"
echo "FILESIZE=${FILESIZE}"
echo "--- Parameter end  ---"

export PHPVERSION=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")

cat <<EOF | sudo tee /etc/php/${PHPVERSION}/fpm/pool.d/www.conf
[www] ; Nginx default configuration file generate by Click-AP
;prefix = /path/to/pools/$pool
user = www-data
group = www-data

listen = /run/php/php${PHPVERSION}-fpm.sock
;listen.backlog = 511
listen.owner = www-data
listen.group = www-data
;listen.mode = 0660
;listen.acl_users =
;listen.acl_groups =
listen.allowed_clients = 127.0.0.1

pm = dynamic
pm.max_children = 1000
pm.start_servers = 200
pm.min_spare_servers = 200
pm.max_spare_servers = 1000
;pm.process_idle_timeout = 10s;
pm.max_requests = 2000
;pm.status_path = /status

;ping.path = /ping
;ping.response = pong

;access.log = log/$pool.access.log
;access.format = "%R - %u %t \"%m %r%Q%q\" %s %f %{mili}d %{kilo}M %C%%"
;slowlog = log/$pool.log.slow

;request_slowlog_timeout = 20
;request_slowlog_trace_depth = 20
request_terminate_timeout = 300

;rlimit_files = 1024
rlimit_files = 65536
;rlimit_core = 0
;chroot =
;chdir = /var/www
;catch_workers_output = yes
;clear_env = no
;security.limit_extensions = .php .php3 .php4 .php5 .php7

;env[HOSTNAME] = $HOSTNAME
;env[PATH] = /usr/local/bin:/usr/bin:/bin
;env[TMP] = /tmp
;env[TMPDIR] = /tmp
;env[TEMP] = /tmp

;php_admin_value[sendmail_path] = /usr/sbin/sendmail -t -i -f www@my.domain.com
;php_flag[display_errors] = off
;php_admin_value[error_log] = /var/log/fpm-php.www.log
php_admin_value[error_log] = /var/log/php${PHPVERSION}-fpm-pool-www.log
php_admin_flag[log_errors] = on
;php_admin_value[memory_limit] = 32M
php_admin_value[memory_limit] = 1024M
php_admin_value[post_max_size] = ${FILESIZE}
php_admin_value[upload_max_filesize] = ${FILESIZE}

EOF

echo "Nginx fpm for WWW configuation generate is done."