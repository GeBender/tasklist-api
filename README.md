# Tasklist API
Simple Tastklist api - Silex / Doctrine

## API RESTFUL RODANDO EM ##
http://tasklist-api.gebender.com.br

### Instalação ###
* Clone este repo
* Instale as dependências via Composer

`composer install`

* Crie um banco de dados
* Configure o banco em /App/Config.php
* Persista o banco via Doctrine:

`cd App`

`../vendor/bin/doctrine orm:schema-tool:create`


### Testando ###
Utilizando o Postman ou similares:


##### Para listar #####
GET > http://tasklist-api.gebender.com.br/tasks


##### Para ver um #####
GET > http://tasklist-api.gebender.com.br/tasks/1


##### Para inserir #####
POST > http://tasklist-api.gebender.com.br/tasks

`Body raw:
{
	"ordem":"2",
	"titulo":"Nova task",
	"task":"Testar API",
	"prazo":"2017-03-27"
}`


##### Para editar #####
PUT > http://tasklist-api.gebender.com.br/tasks/1
`Body raw:
{
	"ordem":"50",
	"titulo":"task editada, nova ordem"
}`


##### Para deletar #####
DELETE > http://tasklist-api.gebender.com.br/tasks/1



:)
