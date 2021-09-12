# 2 Websitesini Çalıştıracak Conf Dosyası

- [x] testdomain.com -> https olarak serve edilecek, http gelen istek https'e redirect edilecek
- [x] domaintest.com -> http olarak serve edilecek

```php
<VirtualHost *:80>
	ServerName http://testdomain.com
	Redirect / https://testdomain.com
       
	ServerAdmin webmaster@localhost
	ServerAlias www.testdomain.com
	DocumentRoot /var/www/html/testdomin

	ErrorLog ${APACHE_LOG_DIR}/testdomain.error.log
	CustomLog ${APACHE_LOG_DIR}/testdomain.access.log combined
</VirtualHost>

# Ücretsiz SSL Sertifikası LetsEncrypt Kurduğumuzu Varsaylım
<IfModule mod_ssl.c>
    <VirtualHost *:443>
        ServerName http://testdomain.com
    
        ServerAdmin webmaster@localhost
        ServerAlias www.testdomain.com
        DocumentRoot /var/www/html/testdomin
    
        ErrorLog ${APACHE_LOG_DIR}/testdomain.error.log
        CustomLog ${APACHE_LOG_DIR}/testdomain.access.log combined
    
    Include /etc/letsencrypt/options-ssl-apache.conf
    SSLCertificateFile /etc/letsencrypt/live/testdomain.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/testdomain.com/privkey.pem
    </VirtualHost>
</IfModule>


<VirtualHost *:80>
	ServerName http://domaintest.com
	Redirect / https://domaintest.com
       
	ServerAdmin webmaster@localhost
	ServerAlias www.domaintest.com
	DocumentRoot /var/www/html/domaintest

	ErrorLog ${APACHE_LOG_DIR}/domaintest.error.log
	CustomLog ${APACHE_LOG_DIR}/domaintest.access.log combined
</VirtualHost>


```
