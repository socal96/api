<?php
$db = require(__DIR__ . '/db.php');
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'pgsql:host=localhost;dbname=api';
$db['username'] = 'postgres';
$db['password'] = '123qwe';

return $db;