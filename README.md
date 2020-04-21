# sempervirens-scratch

SemperVirens is a web application coded with symfony. It's purpose is to guide and help you towards a more sustainable lifestyle, one step at a time.

## To start sempervirens on a local server:

run the following commands in your terminal: 

```bash
composer install
```
```bash
php bin/console doctrine:database:create
```
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```
```bash
php bin/console doctrine:fixtures:load --append
```
And finally: 

```bash
symfony server:start
```
 You are now read to use sempervirens !
 
 ## The functionalities 
 
 Sempervirens gives you access to:
 * Register
 * Login
 * Sorting Quizz
 * Profile page
 * Review of items & possibility to add an item
 * Messages (possibility to send and recieve messages)
 
 Coming soon:
 * Recording of your travels
 * Possibility to accept and accomplish challenges
 
 
 
