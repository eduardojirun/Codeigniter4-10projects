composer create-project codeigniter4/appstarter admin-site
composer require codeigniter4/shield
php spark db:create admin-site
php spark shield:setup
// Si es necesario se ejecutan las migraciones de shield
php spark migrate --all
creacion de config/admin
