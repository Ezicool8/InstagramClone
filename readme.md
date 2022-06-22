Go through the following steps to install and fireup this project

git clone https://github.com/Ezicool8/instagram_clone.git
cd instagram_clone
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
