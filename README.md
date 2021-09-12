# Gereksinimler

```php
Minimum PHP: 7.4
MySQL: 5.7 - 8.0
```

# Kurulum

```php
git clone https://github.com/olgunozoktas/customer-analytics.git
cd customer-analytics
composer install
php artisan migrate --seed
```

.env dosyası içerisinde veritabanı ayarlarının yapılması gerekmektedir.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## 💻 [Ekran Görüntüleri](Documentation/Screenshots/content.md)
## ⌚ [Zamanlanmış Email Gönderimi](Documentation/Jobs/content.md)
## ☁️ [Hava Durumu Widget](Documentation/Weather/content.md)
