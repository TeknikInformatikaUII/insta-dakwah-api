# InstaDakwah

InstaDakwah API is app that used for manage resource used by InstaDakwah Android App.

## How to Use
1. Clone this repository
```
git clone git@github.com:TeknikInformatikaUII/insta-dakwah-api.git
```
2. Cd into that directory
3. Run `composer install`
4. Duplicate `.env.example` to `.env`
5. Provide the `APP_KEY` value with some random string, like:
```
base64:8Y6coT87VMVS5lfWa9ZwbgpWH5YcKhWgzkR/YiJZCNs=
```
6. Set the database settings according to your system's database.
7. Run `php artisan migrate --seed`
8. Run `php artisan passport:install`
9. Copy the output value from `Password grant client` to your `.env`, like:
```
APP_CLIENT_ID=2
APP_CLIENT_SECRET=eRlUMINSSgmqXOUUJIISDQPFpfGODLiPTJ6wUKXQ
```

## Security Vulnerabilities

If you discover a security vulnerability within this API, please send an e-mail to informatics.uii.club@gmail.com. All security vulnerabilities will be promptly addressed.

## License

InstaDakwah Application is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
