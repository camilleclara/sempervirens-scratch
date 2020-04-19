# sempervirens-scratch
SemperVirens is a web application coded with symfony. It's purpose is to guide and help you towards a more sustainable lifestyle, one step at a time.
## To start sempervirens on a local server:
run the following commands in your terminal: 
 'composer install'
 'php bin/console doctrine:database:create' 
 'php bin/console make:migration'
 'php bin/console doctrine:migrations:migrate'
 'php bin/console doctrine:fixtures:load --append'
 
 Then finally
 'symfony server:start'
 
 You are now read to use sempervirens !
 
