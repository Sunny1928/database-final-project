docker pull yuiarthur/db_nginx
docker stop proxy
docker rm proxy
docker run -d -p 80:80 --name proxy yuiarthur/db_nginx
