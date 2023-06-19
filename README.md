# vat_calculator_symphony

#Clone
git clone https://github.com/AdeAbayomi/vat_calculator_symphony.git

#Edit DB
edit db details in .env file on line 28
change the following :
user -> root
password -> calculator
db server -> 127.0.0.1:3306
db name -> vat_calculator
change the details above to your preferred data.

#Generate Database Migrations:
Run the following command to generate the database migrations based on the entity changes:
=> symfony console make:migration
Execute the migrations to create the necessary database tables:
=> symfony console doctrine:migrations:migrate

#Run the Application:
Start the Symfony development server by running the following command:
=> symfony server:start
