<?php
    define('WEBPATH','/');

    define('TITLE','Blood Bank Management');
    define('SUBTITLE','Save Life By Donating Blood');

    define('DEFAULT_CONTROLLER','home');
    define('DEFAULT_ACTION','index');

    define('DEFAULT_LAYOUT','default');

    define('ENVIRONMENT','Development');  /* Test, Production, Deployment, Development */

    /* Database */
    define('DB_HOST','localhost');
    define('DB_NAME','bbdms_db');
    define('DB_USER','root');
    define('DB_PASS','');
    /* Encryption */
    define('ENCRYPTION_KEY','$2y$10$BzmjvJZZj7F9i5/g1g7.M.uf/6QqPjkswFv1LJe/rDTqnl4NP00Py');
    define('ENCRYPTION_ALGORITHM','AES-256-CBC');
    define('PASSWORD_ENC',PASSWORD_DEFAULT);

    /* CSRF */
    define('CSRF_TOKEN','fuce_csrf_protection_token');
    define('CSRF_FIELD','_csrf_token');

    /* Uploading */
    define('UPLOAD_PATH',"public". DS ."uploads" . DS );

    /* Mailing */
    define('MAILER_EXCEPTION',true);
    define('SMTP_SERVER','smtp.mailtrap.io');
    define('SMTP_USER','0250e5202276eb');
    define('SMTP_PASSWORD','4c38324d4a3994');
    define('SMTP_SECURE','TLS');
    define('SMTP_PORT','465');
    define('SMTP_DEBUG',true);
    define('MAIL',array('from'=>'admin@mydomain.com','admin'=>'Administrator'));

    /* Migartion */
    define('RUN_MIGRATION_FROM_BROWSER',false);

    /* Session */
    define('ADMIN_SESSION','admin_session');
    define('USER_SESSION','user_session');
    /* Roles */
    define('ADMIN','admin');
    define('USER','user');
?>