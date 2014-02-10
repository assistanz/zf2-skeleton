AssistanZ ZendFrameWork2 Skeleton Application
=============================================

Directory Structure
-------------------

* build - Final files generated for deployment to production server
* config - Includes various configurations 
* data - Contains database scripts or SQLite DB or Cached files for performance
* module - Logic of the application divided into various modules
* public - Publicly available directories which contains static files like css,js, etc.,
* vendor - Downloaded libraries to support the functionalities of modules via composer(refer getcompoer.org)

Module Structure 
----------------

Every module has the following files and directories

* config  - Module configuration
    * module.config.php - Contains router configuration, dependency services, translator path, view-templates, view-helpers, etc.,
* language - Contains language translation files per language
* src - Module source code written in PSR-0 Standard
* test - Test code to check functionality of the module (Unit Test, Integration Test, etc.,)
* view - View templates to display html and other output
* Module.php - Module Bootstrap initializes the module with required dependencies 

Module coding standards
-----------------------

Explaining the album module

* Controller - Contains controller classes with actions, Mapping between controller and route paths are done in module.config.php
* Dao - Data Access Object layer used to write SQLs and DQLs, Clear separation of data access from functionality this part can even access external SOAP / REST services if they are considered as a data source
* Entity - Doctrine mapped entities which act as objects reference for tables
* Exception - Specific exception related to this module
* Form - Structure and content of html forms which includes validation and filtering to avoid injections and inappropriate data 
* Service - The business logic of the module commonly known as models


Guidelines
----------

* Coding standard should be practiced as in the sample
* Filename should be with PHP 5.3 namespaces and PSR-0 recommendations
* Function names should be with Hungarian notation start with small letter and separate words with capital letter
* Don't store uploaded files inside public directories store it in different location out of this project and use Apache Alias directive to load them 
* Use SVN/Git to version the project and have multiple stages before releasing to production
* Try to write as many test cases as possible to ensure the functionality is without bug
* Run unit tests before committing the code to repository
* Use Phuppet and Vagrant for development and stagging environments if required
* Add all the required libraries and extensions in composer.json 
* Automate deployments and testing using a continues integration system like Jenkins/Hudson if possible



DB Tools
------

* ORM Mapped entities can be generated to tables using scripts
    *  [~/project.base]$ php vendor/bin/doctrine
* Automated Table creation should not be done in production via doctrine save the SQL and run it via migration scripts
    * [~/project.base]$ php vendor/bin/doctrine orm:schema-tool:update --dump-sql
    * [~/project.base]$ php ./vendor/bin/doctrine-module migrations:generate --configuration config/migrations.yml
    * Save the change add your own changes (Refer http://docs.doctrine-project.org/projects/doctrine-migrations/en/latest/reference/migration_classes.html)
    * In production run the following
    * [~/project.base]$ php ./vendor/bin/doctrine-module migrations:migrate --configuration config/migrations.yml


Security and Pre-developed Modules
----------------------------------

* The application can use various other modules available from Zend Framework community http://modules.zendframework.com/
* Security can be implemented as explained in https://github.com/bjyoungblood/BjyAuthorize

