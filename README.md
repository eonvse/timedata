# Система учета событий
## Развертывание:
```cmd
	mysql -u root -p
   	mysql> set global log_bin_trust_function_creators=1;
   	mysql> show variables like '%log_bin_trust_function_creators%';
```   	
### Create .env + database
```cmd
	composer install
	npm install
	sudo chmod -R 775 storage
	sudo chown -R $USER:www-data storage
	php artisan key:generate
	php artisan migrate
	php artisan db:seed --class=DarkColorsSeeder
	php artisan db:seed --class=ModelTypeSeeder
	php artisan db:seed --class=OperationTypeSeeder
	php artisan storage:link
	npm run dev
	npm run build
```
## Синхронизация БД
### Под вопросом

```cmd
mysqldump -uroot -p timedata files information notifications teams team_users time_events users visits > timedata.sql  --skip-comments --skip-triggers --no-create-info --replace
```
> [!IMPORTANT]
> Не загружается information.

> [!IMPORTANT]
> users не желательно тягать через общедоступный репозитарий

## Авторские права:
* Фреймворки
	* [Laravel 10](https://laravel.com/docs/10.x)
	* [Tailwindcss 3](https://tailwindcss.com/docs/installation)
	* [Livewire 3](https://livewire.laravel.com/docs)
* SVG иконки
	* [Tailwind Toolbox](https://tailwindtoolbox.com/icons)
	* [SVG Repo - Search, explore, edit and share open-licensed SVG vectors](https://www.svgrepo.com/)

