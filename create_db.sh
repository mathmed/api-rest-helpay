#!/bin/bash
sudo docker exec -it helpay_app /bin/bash -c "cd /var/www/ && php artisan migrate && php artisan db:seed"
