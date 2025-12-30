<?php 


## Configuration in mysql

open file my.ini (on window) or my.cnf (linux)

1. Log 


Types Of Log 

Error Log       
General Query Log         ->  Records all SQL queries received by the server, including connect, disconnect, and failed queries.
Slow Query Log            ->  
Binary Log                ->  
Relay Log (Replication)   ->  
Audit Log                 ->  
Transaction Log           ->  

Error Log 

    Purpose ->  Captures information about errors, warnings, and critical events such as startup or shutdown of the MySQL server.
    Usages  ->  Helps diagnose issues such as server crashes, startup issues, or other errors. 

General Query Log 

    Purpose ->  Records all SQL queries received by the server, including connect, disconnect, and failed queries.
    Usages  ->  Useful for debugging and analyzing all SQL activity on the server. Be cautious with its use due to performance impact.

Slow Query Log 

    Purpose ->  Logs queries that take longer than a specified time (long_query_time) to execute.
    Usages  ->  Helps identify and optimize slow-running queries that could impact performance.

Binary Log 

    Purpose ->  Records all changes to the database (e.g., updates, deletes) and is used for replication and recovery.
    Usages  ->  Essential for database replication and point-in-time recovery.

Relay Log 

    Purpose ->  Used in replication to store data that is being copied from the master to the slave server.
    Usages  ->  Critical for replication, especially in multi-server setups.

Audit Log 

    Purpose ->  Captures detailed information about database activity, useful for security auditing and compliance.
    Usages  ->  Monitors and logs all database activities for security and compliance purposes.

Transaction Log 

    Purpose ->  Records transactions and helps in crash recovery by ensuring data integrity.
    Usages  ->  Important for maintaining data integrity and ensuring that transactions are properly committed or rolled back.



[mysqld]
# Error log
log_error = "C:/xampp/mysql/data/mysql_error.log"

# General query log
general_log = 1
general_log_file = "C:/xampp/mysql/data/general_query.log"

# Slow query log
slow_query_log = 1
slow_query_log_file = "C:/xampp/mysql/data/slow_query.log"
long_query_time = 2

# Binary log
log_bin = "C:/xampp/mysql/data/mysql-bin"
binlog_format = ROW

# Relay log (for replication)
relay_log = "C:/xampp/mysql/data/mysql-relay-bin"

# Audit log (requires audit plugin)
plugin-load = audit_log.so
audit_log_file = "C:/xampp/mysql/data/audit.log"

# InnoDB transaction log
innodb_log_group_home_dir = "C:/xampp/mysql/data/"
innodb_log_file_size = 50M
innodb_log_files_in_group = 2



# you can use to check and analyze the performance of your database queries and overall system performance. 

    1. EXPLAIN
    2. SHOW STATUS
    3. SHOW VARIABLES
    4. SHOW PROCESSLIST
    5. SHOW PROFILES
    6. SHOW ENGINE INNODB STATUS
    7. ANALYZE TABLE
    8. OPTIMIZE TABLE
    9. INDEX USAGE ANALYSIS
    10. PERFORMANCE SCHEMA
    11. USER STATISTICS

2.  EXPLAIN 

    The EXPLAIN command in MySQL is a powerful tool used to analyze and understand how MySQL executes a particular SQL query. 

    When you run an EXPLAIN query, MySQL returns a result set with several columns

    id:
    select_type (SIMPLE,PRIMARY,SUBQUERY,DERIVED)
    table
    partitions
    type  (ALL,INDEX,RANGE,REF,EQ_REF,CONST)
    possible_keys
    key
    key_len
    ref
    rows
    filtered
    Extra     (index,where,filesort,temporary)


3. Select Sleep(seconds)





Query Optimization 

    Index 
        Indexes usages (WHERE, JOIN, ORDER BY, and GROUP BY clauses.)
    
    Query Design

        Select Only Required Columns: Avoid using SELECT *. Specify only the columns you need to reduce the amount of data processed.
        Avoid Redundant Operations: Minimize the number of operations in your query. For example, avoid redundant calculations or conversions.
        Use Joins Efficiently: Prefer INNER JOIN over OUTER JOIN when possible, as INNER JOIN can be more efficient.

    Limit Result Sets

        LIMIT 1, 10;

    Avoid Unnecessary Calculations

        -- Inefficient
        SELECT * FROM employees WHERE YEAR(hire_date) = 2024;

        -- Efficient
        SELECT * FROM employees WHERE hire_date BETWEEN '2024-01-01' AND '2024-12-31';

    Avoid Subqueries When Possible

        -- Subquery (can be less efficient)
        SELECT first_name, last_name
        FROM employees
        WHERE department_id IN (SELECT department_id FROM departments WHERE location = 'New York');

        -- Join (typically more efficient)
        SELECT e.first_name, e.last_name
        FROM employees e
        INNER JOIN departments d ON e.department_id = d.department_id
        WHERE d.location = 'New York';

    Optimize ORDER BY and GROUP BY (Avoid Unnecessary Sorting)

        -- Efficient
        SELECT department_id, COUNT(*)
        FROM employees
        GROUP BY department_id
        ORDER BY department_id;

        Note :- Ensure that sorting is necessary and that it uses indexed columns if possible.

    Use Efficient Data Types    




    Mysql Database Configurations 

        1. Memory Allocation

            innodb_buffer_pool_size = 2G
            key_buffer_size = 512M
            query_cache_size = 64M

        2. Connection Handling

            max_connections = 200
            connections = 200
            connect_timeout = 10
            wait_timeout = 28800
            interactive_timeout = 28800

        3. Transaction Handling

            innodb_log_file_size = 256M
            innodb_flush_log_at_trx_commit = 1

        4. Performance and Optimization

            innodb_file_per_table = ON
            innodb_io_capacity = 1000
            tmp_table_size = 64M
            max_heap_table_size = 64M

        5. Logging and Monitoring

            log_error

                log_error = /var/log/mysql/mysql-error.log

            slow_query_log

                slow_query_log = ON
                slow_query_log_file = /var/log/mysql/mysql-slow.log
                long_query_time = 2

            performance_schema = ON


        6.  Sql Mode 

            sql_mode = STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE

        
        others 

            [mysqld]
                basedir="C:/xampp/mysql"
                datadir="C:/xampp/mysql/data"
                port=3306
                bind-address=127.0.0.1
                max_connections=200
                max_allowed_packet=64M
                query_cache_size=16M
                innodb_buffer_pool_size=1G
                innodb_log_file_size=256M
                innodb_file_per_table=1
                default_storage_engine=InnoDB
                sql_mode="STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE"
                character-set-server=utf8mb4
                collation-server=utf8mb4_unicode_ci
                log-error="C:/xampp/mysql/data/mysql_error.log"
                pid-file="C:/xampp/mysql/data/mysqld.pid"
                thread_cache_size=50
                table_open_cache=2000
                open_files_limit=65535
                tmp_table_size=64M
                max_heap_table_size=64M

    How to Create Multiples User and They Have Specific Operation Strict 

        Access MySql 

            mysql -u root -p 

        Create Database 

            create database database_name 

        Create User 

            create user user_name identified by user_password 
        
        Grant Access 

            GRANT SELECT, INSERT, UPDATE, DELETE ON db1.* TO 'user1'@'localhost';
            FLUSH PRIVILEGES;

        Verifying Permissions   

            SHOW GRANTS FOR 'user1'@'localhost';


        User Management

            CREATE USER 'username'@'host' IDENTIFIED BY 'password';
            ALTER USER 'username'@'host' IDENTIFIED BY 'new_password';
            DROP USER 'username'@'host';

        Grant Permission 

            Global Privileges: Apply to all databases
            Database Privileges: Apply to all tables within a specific database.
            Table Privileges: Apply to a specific table within a database.
            Column Privileges: Apply to specific columns in a table.

            GRANT ALL PRIVILEGES ON database_name.* TO 'username'@'host';
            GRANT SELECT, INSERT, UPDATE ON database_name.table_name TO 'username'@'host';
            GRANT SELECT (column1, column2), INSERT (column1) ON database_name.table_name TO 'username'@'host';

            SHOW GRANTS FOR 'username'@'host';

            REVOKE privilege_type ON database_name.* FROM 'username'@'host';

            FLUSH PRIVILEGES;

