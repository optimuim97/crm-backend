
# crm-backend

## Copier .env
```
cp .env.example .env
```

### Générer la clé d'application
```
php artisan key:generate
```

### Configurer la base de données
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

### Lancer les migrations et les seeders
```php artisan migrate --seed```

### Installer Laravel Passport
 ```php artisan passport:install```

### lancer le serveur
 ``` php artisan serve ```
### Le nom d'utilisateur et le mot de passe sont dans les seeders et le port pour faire fonctionner le front est le port ```7777```


#crm-backend
