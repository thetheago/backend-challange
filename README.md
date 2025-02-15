# Sobre o projeto 💲

Bem-vindo(a)! Este é um projeto de desafio que realizei.

É uma API Restful que faz transferências de dinheiro entre um usuário e outro, com algumas regras de negócios e tratamentos de erro para garantir a segurança das transferências.

Aqui você encontrará informações úteis sobre o projeto. Sinta-se a vontade para me chamar caso teha alguma dúvida, via e-mail: theago.dev@gmail.com.

## Como rodar o ambiente ☕️
### Requisitos
- Docker
- Docker compose

### Comandos
Tendo os requisitos acima, é só rodar ```docker compose up -d``` e ele irá baixar todas as imagens necessárias:
- php 8^
- mysql8.0
- beanstalkd

## Como rodar os testes 🧪
Para rodar os testes vá no diretório do docker-compose.yml e rode o comando ```docker compose exec payment vendor/bin/phpunit```

## Documentação das rotas 📜
### POST /transfer
#### Payload
```
{
  "value": 100.20,
  "payer": 4,
  "payee": 15
}
```
#### Response
```
200 Ok
{
    "message": "Your transfer will be processed in a few seconds."
}
```
#### Fluxo
![Fluxograma](https://github.com/thetheago/backend-challange/blob/main/architecture.png)
Link : https://miro.com/app/board/uXjVK4nECBE=/?share_link_id=186829003122

### GET /user - Retorna todos os usuários
#### Response
```
200 Ok
[
    {
		"id": 1,
		"name": "Freddie Mercury",
		"email": "freddie.mercury@queen.com",
		"cpf": "123.456.789-10",
		"shopkeeper": true,
		"amount": 300
	},
	{
		"id": 2,
		"name": "Elvis Presley",
		"email": "elvis.presley@king.com",
		"cpf": "111.222.333-44",
		"shopkeeper": false,
		"amount": 500.5
	},
	...
]
```

### GET /user/{id} - Retorna todos os usuários
#### Response
```
200 Ok
[
    {
		"id": 1,
		"name": "Freddie Mercury",
		"email": "freddie.mercury@queen.com",
		"cpf": "123.456.789-10",
		"shopkeeper": true,
		"amount": 300
	}
]
```

### POST /user
#### Payload
```
{
    "name": "Freddie Mercury",
    "email": "freddie.mercury@queen.com",
    "cpf": "123.456.789-10",
    "shopkeeper": true,
    "amount": 300
}
```
#### Response
```
201 Created
{
    "id": 1,
    "name": "Freddie Mercury",
    "email": "freddie.mercury@queen.com",
    "cpf": "123.456.789-10",
    "shopkeeper": true,
    "amount": 300
}
```

## Projetos pessoais usados como referência ✨

- Projeto em PHP para filtrar planos de telefone https://github.com/thetheago/CellphonePlans
- Projeto em Java da faculade sobre a apresentação do pattern Chain of Responsibility https://github.com/thetheago/Chain-of-Responsibility-Apresentation


## Nota pessoal ❤️

Como serviço de e-mail é apenas para simulação e não envia e-mail de verdade, estou logando no arquivo notifications.log que irá ser criado no /src.

Apesar de não ter feito tudo que planejei, irei continuar dando continuidade neste projeto para fim de estudo e conclusão do próprio. Obrigado pela oportunidade de participar do desafio!
