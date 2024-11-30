<p align="center">
    <h1 align="center">Yii2 User API test project</h1>
    <br>
</p>


Установка
------------

### Клонировать проект

~~~
https://github.com/pykam/yii-user.git
~~~

### Установить зависимости

~~~
php composer.phar install 
~~~

### Создать  базу данных, запустив миграции

~~~
php yii migrate
~~~

### Опционально можно сгененрировать тестовых пользователей

~~~
php yii fixture/generate-all --count=30
php yii fixture/load User
~~~


## Доступные методы

Без авторизации доступен только метод создания пользователя

### Создание пользователя POST /users
~~~
POST /users
~~~
Принмает JSON вида:

```JSON
{
    "firstanme": "Ivan",        //объязательное поле
    "lastname": "Ivaonov",      //можно оставить пустым
    "email": "ivanov@mail.ru",  //объязательное поле
    "password": "test",         //объязательное поле
}
```

Остальные методы доступны только авторизированным пользователям

### Список пользователей GET /users
~~~
GET /users
~~~
Возвращает список всех пользователей c пагинацией по 20 ззаписей

### Информация о пользователе GET /users/<id>
~~~
GET /users/12
~~~

### Обновление информации о пользователе PUT /users/<id>
~~~
PUT /users/12 или PATCH /users/12
~~~

В теле запроса необходимо отправить JSON вида:
```JSON
{
    "firstanme": "Misha"
}
```

### Удаление пользователя DELETE /users/<id>
~~~
DELETE /users/12
~~~
