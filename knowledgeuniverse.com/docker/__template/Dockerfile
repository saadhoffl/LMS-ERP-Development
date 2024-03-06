FROM ubuntu:latest
ARG DEBIAN_FRONTEND=noninteractive
RUN apt update
RUN apt upgrade -y
RUN apt install -y apache2
RUN apt install -y php libapache2-mod-php php-mysql
RUN a2enmod rewrite
RUN apt install -y nano
RUN rm /var/www/html/index.html
COPY ./scripts/entry.sh /var/www/scripts/knowledegeuniverse.com_config/entry.sh
CMD /var/www/scripts/knowledegeuniverse.com_config/entry.sh