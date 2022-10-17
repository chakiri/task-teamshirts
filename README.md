Build the project :
`docker-compose up -d`

Add `127. 0.0.1 task-teamshirts.local` to your machine host file

Run `composer install` to load dependencies

No database needed

Run `docker exec -it task_php bash` to enter into the php container

Run `phpunit` to run unit tests, 
if no found configure the alias `alias phpunit="vendor/phpunit/phpunit/phpunit"`  