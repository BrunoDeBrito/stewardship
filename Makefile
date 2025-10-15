# Definição do shell para o Makefile
SHELL := /bin/bash

# Nome do serviço da aplicação dentro do Docker
APP_CONTAINER = $(shell docker compose ps -q app)

# Exibe opções disponíveis
help:
	@echo "Comandos disponíveis:"
	@echo "  make build         - Builda e sobe os containers do Docker"
	@echo "  make up            - Inicia os containers do Docker"
	@echo "  make down          - Para e remove os containers"
	@echo "  make restart       - Reinicia os containers"
	@echo "  make bash-app      - Entra no container do Laravel (app)"
	@echo "  make bash-mysql    - Entra no container do MySQL"
	@echo "  make bash-nginx    - Entra no container do Nginx"
	@echo "  make artisan cmd='migrate' - Executa um comando no Artisan"
	@echo "  make artisan-all 'comando' - Executa qualquer comando no Artisan"
	@echo "  make artisan-list  - Exibe os comandos disponíveis do Artisan"
	@echo "  make composer cmd='install' - Executa um comando no Composer"
	@echo "  make npm cmd='install' - Executa um comando no npm"
	@echo "  make test          - Executa os testes do Laravel"
	@echo "  make migrate       - Roda as migrações e seeders"
	@echo "  make fresh-migrate - Roda 'migrate:fresh --seed' no Artisan"
	@echo "  make clear 		- Limpa caches da aplicação Laravel"

# Builda e sobe os containers
build:
	docker compose up -d --build

# Sobe os containers do Docker
up:
	docker compose up -d

# Para e remove os containers
down:
	docker compose down

# Reinicia os containers
restart:
	make down
	make up

# Acessa o container do Laravel (app)
bash-%:
	@CONTAINER=$$(docker compose ps -q $*); \
	if [ -z "$$CONTAINER" ]; then \
		echo "Erro: O container '$*' não está rodando."; \
		exit 1; \
	fi; \
	docker exec -it $$CONTAINER bash

# Executa um comando no Artisan (ex: make artisan cmd='migrate')
artisan:
	docker exec -it $(APP_CONTAINER) php artisan $(cmd)

# Executa qualquer comando no Artisan (ex: make artisan-all migrate)
artisan-all:
	docker exec -it $(APP_CONTAINER) php artisan $(filter-out $@,$(MAKECMDGOALS))

# Exibe os comandos disponíveis no Artisan
artisan-list:
	docker exec -it $(APP_CONTAINER) php artisan

# Executa um comando no Composer (ex: make composer cmd='install')
composer:
	docker exec -it $(APP_CONTAINER) composer $(cmd)

# Executa um comando no npm (ex: make npm cmd='install')
npm:
	docker exec -it $(APP_CONTAINER) npm $(cmd)

# Executa os testes do Laravel
test:
	docker exec -it $(APP_CONTAINER) php artisan test

# Executa as migrações e seeders
migrate:
	docker exec -it $(APP_CONTAINER) php artisan migrate --seed

# Executa migrate:fresh --seed
migrate-fresh:
	docker exec -it $(APP_CONTAINER) php artisan migrate:fresh --seed

# Limpa caches da aplicação Laravel
clear:
	docker exec -it $(APP_CONTAINER) php artisan cache:clear
	docker exec -it $(APP_CONTAINER) php artisan route:clear
	docker exec -it $(APP_CONTAINER) php artisan config:clear
	docker exec -it $(APP_CONTAINER) php artisan config:cache
	docker exec -it $(APP_CONTAINER) php artisan view:clear
	docker exec -it $(APP_CONTAINER) php artisan event:clear


# Permite que comandos sem variáveis sejam passados corretamente
%:
	@:
