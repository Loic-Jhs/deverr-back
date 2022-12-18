# Rôles des développeurs :

Product Owner :
- Théo Hérédia

Project Manager :
- Giovanni Milet

Front-end lead developer :
- Loïc Jouhans

Front-end developers:
- Giovanni Milet
- Théo Hérédia

Lead developer back-end :
- Donovan Basset

Back-end developers :
- Théo Hérédia
- Ethan Eldib

Git master :
- Ethan Eldib

## Au clonage du projet :

- `docker run --rm -it -v $PWD:/app loan91/tools:composer81 install` <== permet d'installer les dépendances sans avoir à se soucier de la version de composer
- Copier le .env.example en .env 
- modifier le .env avec: 
    ```
    FRONT_URL=the_url_of_the_front_end
    DB_CONNECTION=mysql
    DB_HOST=mariadb
    DB_PORT=3306
    DB_DATABASE=deverr
    DB_USERNAME=root
    DB_PASSWORD=password
    ```
- lancer la commande: `./vendor/bin/sail build --no-cache` <== permet de build 
- lancer la commande: `./vendor/bin/sail up -d` <== lance le conteneur avec l'application
- lancer la commande: `./vendor/bin/sail artisan key:generate`
- lancer la commande: `./vendor/bin/sail artisan migrate` <== lance les migrations 

## Au cas où si mariadb bug:
    `./vendor/bin/sail down -v`
 Essayer de re-build 
 Relancer avec `./vendor/bin/sail up -d`
