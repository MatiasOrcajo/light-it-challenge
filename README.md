1. Clone this repo
2. Set MAIL_USERNAME and MAIL_PASSWORD in .env with keys given by Mailtrap
3. Run docker compose up --build -d to running the project's container
4. In console, at the project path, run docker exec -it challenge sh to enter container console
5. Run composer install
6. Run php artisan migrate
7. Run php artisan queue:work to set a worker to listen for jobs
8. Make POST request to the route http://localhost:8080/api/patient to store a new patient in DB with the following form-data:
    - name
    - email
    - address
    - phone
    - document_photo (.jpg, .png)
  
9. Additionaly, you can run php artisan test to assert the application is working
