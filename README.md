# Homework: building blog page
# Homework to evalute for internship
This is a project for interns. All application execution is done using Docker Sail. The development environment is configured using docker-compose. Written in laravel and vuejs
# Set up Develop
## Packe required 
docker-sail、docker-compose、npm 
## Execute only once when building the development environment
sail artisan db:seed
# Technology used
Laravel(10.32.1), laravel-mix(^6.0.49), vuejs(^2.6.12),... 
## List of feature
- [X] Login Page
- [X] Register account
- [X] Manage role basic: admin, editor
- [X] Manage Post: CRUD, send mail to admin after save a post. 
- [X] Manage User: CRUD, send notification to slack after create user. 
- [X] Change CRUD user to vuejs 
## Images of feature
# Home
![image](https://github.com/lanlh2023/blog-homework/assets/147787873/82ce1df3-d289-4c0f-bc62-d5a55a5992f9)
# Admin user
![image](https://github.com/lanlh2023/blog-homework/assets/147787873/70851bb5-eb4a-4f94-a685-728fb177ad73)
# Send notification to slack after register user
![image](https://github.com/lanlh2023/blog-homework/assets/147787873/12a0dbdf-969a-41de-871f-94a7a072a445)
# Send mail by mail trap after save post
![mailmail](https://github.com/lanlh2023/blog-homework/assets/147787873/df9af23d-8431-417f-9680-d2dec6dfd636)
