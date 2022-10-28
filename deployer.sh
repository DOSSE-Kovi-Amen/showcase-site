set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan  down --message 'The a^^ is being (quickly!) updated. Please try in a minute'
# Update codebase
git pull origin master
# Exit maintenance mode
php artisan update

echo "Application deployed!"

