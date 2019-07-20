Setting Up

1. Clone the project
	git clone https://github.com/maydotimas/users-vue.git
2. cd users-vue
3. Install dependencies
   composer install
   yarn install
4. Make .env file
   cp .env.example .env
5. Edit .env file setup database config
6. Generate app key
	php artisan key:generate
	php artisan passport:keys
7. Migrate files
9. Compile assets
	npm run dev 
	npm run production
8. Serve 
	php artisan serve






