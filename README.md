<h1>...Система учета событий...</h1>
<p>Развертывание:</p>
<code>
	mysql -u root -p
   	mysql> set global log_bin_trust_function_creators=1;
   	mysql> show variables like '%log_bin_trust_function_creators%';
</code>
<p>Create .env + database<p>
<code>
	composer install
	npm install
	sudo chmod -R 775 storage
	sudo chown -R $USER:www-data storage
	php artisan key:generate
	php artisan migrate
	php artisan db:seed --class=ColorsSeeder
	php artisan db:seed --class=ModelTypeSeeder
	php artisan db:seed --class=OperationTypeSeeder
	php artisan storage:link
	npm run dev
	npm run build
</code>

