# POC sur une petite boutique e-commerce avec le Framework Symfony
Suivit par : Fanny BAULU, développeur chez Apitic

# Liste des commandes à effectuer
cd lpweb-symfony
... Ajout de mes variables d'environnement dans le fichier .env ...
docker-compose build --no-cache
docker-compose up -d
docker exec -it symfony-php bash
composer install
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
