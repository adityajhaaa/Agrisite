# AgroMart - Agricultural E-commerce Platform

AgroMart is a comprehensive e-commerce platform designed for agricultural products, connecting farmers and suppliers with customers.

## Features

- User Authentication (Login/Register)
- Product Catalog with Categories
- Shopping Cart Functionality
- Product Search and Filtering
- Responsive Design
- Admin Dashboard (coming soon)

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- mod_rewrite enabled (for Apache)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/agromart.git
cd agromart
```

2. Create a MySQL database:
```sql
CREATE DATABASE agromart_db;
```

3. Import the database schema:
```bash
mysql -u your_username -p agromart_db < database/schema.sql
```

4. Configure your database connection:
   - Copy `config.sample.php` to `config.php`
   - Update the database credentials in `config.php`

5. Set up your web server:
   - Point your web server's document root to the project directory
   - Ensure the following directories are writable:
     - `/images/products`
     - `/images/categories`
     - `/uploads`

## Deployment

### Local Development

1. Start your local server:
```bash
php -S localhost:8000
```

2. Visit `http://localhost:8000` in your browser

### Production Deployment

1. Update `config.php` with production database credentials
2. Set appropriate file permissions:
```bash
chmod 755 -R /path/to/project
chmod 777 -R /path/to/project/images
chmod 777 -R /path/to/project/uploads
```

3. Configure your web server (Apache example):
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /path/to/project
    
    <Directory /path/to/project>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/agromart_error.log
    CustomLog ${APACHE_LOG_DIR}/agromart_access.log combined
</VirtualHost>
```

## Security Considerations

1. Always use HTTPS in production
2. Keep PHP and MySQL updated
3. Use strong passwords
4. Regularly backup your database
5. Monitor error logs

## Database Structure

The application uses the following main tables:
- users
- products
- categories
- cart
- orders (coming soon)

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email support@yourdomain.com or create an issue in the GitHub repository. 