<p align="center">
    <h1 align="center">Yii2 User API test project</h1>
    <br>
</p>


Установка
------------

### Клонировать проект

~~~
git clone
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

~~~
POST /users/create
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

~~~
GET /users
~~~
Возвращает список всех пользователей