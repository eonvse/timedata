# Система учета событий
## Развертывание:
```cmd
	mysql -u root -p
   	mysql> set global log_bin_trust_function_creators=1;
   	mysql> show variables like '%log_bin_trust_function_creators%';
```   	
***Create .env + database***
```cmd
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
```
```cmd
mysqldump -uroot -p timedata files information notifications teams team_users time_events users visits > timedata.sql  --skip-comments --skip-triggers --no-create-info --replace
```

