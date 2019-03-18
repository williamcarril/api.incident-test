# api.incident-test

## Tecnologias
A API do CRUD de incidentes foi escrita em PHP7 usando o framework Symfony 4. Foi usado o MySQL como banco de dados.

## Como executar?
É importante que exista e esteja disponível no PATH de seu ambiente o gerenciador de pacotes "composer" (https://getcomposer.org/download/), a versão do PHP (https://secure.php.net/manual/pt_BR/install.php) com as extensões "ctype" e "iconv" habilitadas, e o Docker Compose (https://docs.docker.com/compose/install/).

Feito isso, inicie o shell de seu sistema dentro do diretório deste projeto e execute os comandos:
`composer install` e, depois, `docker-compose up`

Observação: a API precisará utilizar a porta 8080 de sua máquina. Então certifique-se que tal porta esteja livre.

Um apelido para execução deste dois comandos pode ser utilizado caso possua o utilitário "make" em seu PATH:
`make start`

Espere a instalação de dependências e a construção dos conteineres. E então abra outro shell no mesmo diretório e inicialize o banco de dados através do comando: `php bin/console doctrine:migrations:migrate` ou `make migrate`.

Após isso, já é possível acessar a API através do endereço http://127.0.0.1:8080.
