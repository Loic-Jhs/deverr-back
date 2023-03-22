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

- lancer la commande: `./vendor/bin/sail build --no-cache` <== permet de build le conteneur docker
- lancer la commande: `./vendor/bin/sail up -d` <== lance le conteneur avec l'application
- lancer la commande: `./vendor/bin/sail artisan key:generate` <== génère une clé d'application pour token csrf / encrypter les cookies etc.
- lancer la commande: `./vendor/bin/sail artisan migrate --seed` <== lance les migrations avec les seeders

## Au cas où si mariadb bug:
    `./vendor/bin/sail down -v`
 Essayer de re-build et relancer la commande `./vendor/bin/sail up -d`

 ## Mailing
 Pour accéder au mails envoyés par l'application, il suffit de se rendre sur l'adresse suivante: https://mailosaur.com/ 
 OU sur le port `localhost:8025`
