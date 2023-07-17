migrate: 
	cd qr_generator && \
	docker exec -d app_qr /bin/bash && \
	php artisan migrate