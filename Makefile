
##################################
## Installation related targets ##
##################################
.PHONY: install
install:
	@composer install

###########################
## Build related targets ##
###########################
.PHONY: build
build:
	@docker-compose build

#########################
## Run related targets ##
#########################
.PHONY: run
run:
	@docker-compose up

.PHONY: start
start: install build run
