## Тестовое задание Mello Inc
### Условия задания 

Необходимо создать проект на Laravel (REST API), только Backend! Предметная область для данных на Ваше усмотрение. Особенности реализации:

1. Проект содержит базу данных из двух таблиц со связью многие ко многим;
2. Работа с базой должна осуществляться через паттерн репозиторий;
3. Необходимо реализовать простую аутентификацию через ключ (не используя доп. пакеты passport, jwt etc.);
4. API должно предоставлять доступ к данным с возможностью сортировки и поиску по нескольким полям;
5. В процессе работы с данными необходимо использовать атрибут pivot для моделей и включить его в запросы по поиску.
   В качестве результата ссылка на GitLab/GitHub/Bitbucket на выбор, сам репозиторий назвать 0290

А также Postman-коллекция, README с описанием и необходимыми действиями для развертывания проекта


### Предметная область

Предметная область состоит из 2-х таблиц: 
Посты и теги со связью многие ко многим.

С помощью API можно получать посты, теги, сортировать по выбранному полю,  производить поиск фразы в ключевых полях поста 
title, code, detail_text, аналогично можно сортировать теги поста и искать по name, code тега, а также по pivot свойству color.

Структура БД:

Posts
- id
- created_at
- updated_at
- title
- code
- detail_text
- published

Tags
- id
- created_at
- updated_at
- name
- code

Post_tag

- id
- post_id
- tag_id
- color

### Примеры запросов

**GET** localhost/api/v1/posts - Получение всех постов 

**GET** localhost/api/v1/posts/{id} - Получение поста

**GET** localhost/api/v1/posts/{id}/tags - Получение тегов поста

Для сортировки необходимо в заголовках передать 2 параметра:
- **sort** - значение выбираемое поле для сортировки
- **order** - значение порядок сортировки **asc**, **desc**

Для поиска по ключевым столбцам необходимо передать 1 параметр:
- **q** - значение поисковая подстрока

Для маршрута localhost/api/v1/posts используется постраничная навигация, параметр page отдает 15 постов по умолчанию
Чтобы выбрать страницу необходимо передать параметр:

- **page** - значение номер страницы

Коллекция **Postman** с примерами запросов расположена в корне проекта файл:

**Mello Test Posts API Collection.postman_collection.json**

### Запуска проекта

1) Склонировать репозиторий 
2) Запустить докер контейнер с помощью [Sail](https://laravel.com/docs/9.x/sail#installing-sail-into-existing-applications)
3) Прописать настройки к БД 
4) Выполнить migrations и seeds
   
   `php artisan migrate:refresh --seed`
5) Приложение готово к работе, можно тестировать API с помощью Postman , при необходимости поменяв хост, если
используется отличный от localhost
