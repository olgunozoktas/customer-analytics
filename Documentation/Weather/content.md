# Hava Durumu Widget

İlgili sayfanın düzgün çalışması için ``.env`` dosyası içerisine https://openweathermap.org/api adresinden elde edilecek API_KEY eklenmelidir.

```php
APP_NAME=Laravel
...
...
...
OPEN_WEATHER_API_KEY=YOUR_API_KEY
```
Şu anda, eğer ilgili API_KEY'i eklemezsenizde sayfa benim API_KEY'im ile birlikte çalışmaya devam edecektir, ancak belli bir süre sonra ilgili API_KEY deactive edildiğinde sayfa çalışmayacaktır.
