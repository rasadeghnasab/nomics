SAIL=bash ./vendor/bin/sail

# Colors
GREEN=\033[0;32m
BOLD_GREEN=\033[1;32m

ADDRESS=http://localhost

project:
	$(SAIL) up -d && echo "Visit this URL:${BOLD_GREEN} ${ADDRESS}"

dev:
	$(SAIL) up

dev-stop:
	$(SAIL) down
