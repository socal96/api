API application for Yii 2 Basic Project Template 
============================

App
DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------
### 1.Clone repository
### 2.Update Composer
### 3.Create pgsql database with name "api"
### 4.In app path execute : yii migrate
### 5.Open your browser and go to localhost



TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).

- `unit`

- Edit codeception.yml in /vendor/bin
### actor: Tester
### paths:
###    tests: ../../tests
###    log: ../../tests/_output
###    data: ../../tests/_data
###    support: ../../tests/_support
###    envs: ../../tests/_envs
### settings:
###    bootstrap: _bootstrap.php
###    colors: false
###    memory_limit: 1024M
### extensions:
###    enabled:
###        - Codeception\Extension\RunFailed
### modules:
###    config:
###        Db:
###            dsn: ''
###            user: ''
###            password: ''
###            dump: tests/_data/dump.sql


For run Tests execute command
```
vendor/bin/codecept run
``` 

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


