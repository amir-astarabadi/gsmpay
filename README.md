# Running Project On Local

    - clone project
    - docker compose build
    - docker compose up -d
    - docker exec -it gsmpay_php sh
    - composer install
    - cp .env.example .env
    - php artisan deploy 
    - php artisan test
    - add an image with the name of default_profile.png in the path storage/app/public/user/profiles
    - chmod -R 777 * (just for local)
    - add gsmpay.postman_collection.json to postman for manual tests
