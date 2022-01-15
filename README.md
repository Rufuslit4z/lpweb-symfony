# POC sur une petite boutique e-commerce avec le Framework Symfony
Suivit par : Fanny BAULU, développeur chez Apitic.  
Lien du sujet : https://github.com/FannyBauluApitic/TP_NOTE  
Lien non disponible ? Cliquez ici : https://github.com/Rufuslit4z/lpweb-symfony/blob/main/sujet.md 
# Liste des commandes à effectuer
```bash
cd lpweb-symfony
# Ajout des variables d'environnement dans le fichier .env
docker-compose build --no-cache
docker-compose up -d
docker exec -it symfony-php bash
composer install
# Supprimer les fichiers "Version*.php" dans lpweb-symfony/migrations
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

# Lest ports d'accès
symfony : 7780  
phpmyadmin : 7779

# Page d'accueil
http://localhost:7780/home
