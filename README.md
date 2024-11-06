# TpnoteArchi_Ayachafi

commande utilisé dans projet symfony 

composer create-project symfony/skeleton my_project
cd my_project
composer require symfony/orm-pack
composer require doctrine/doctrine-bundle
composer require symfony/maker-bundle --dev
dans .env
DATABASE_URL="mysql://root:@127.0.0.1:3306/tpnote?serverVersion=8.0&charset=utf8mb4"
php bin/console doctrine:database:create 

php bin/console make:entity Acteur 
php bin/console make:migration
php bin/console doctrine:migrations:migrate 
php bin/console doctrine:migrations:rollback

php bin/console make:crud Auteur

symfony serve 
