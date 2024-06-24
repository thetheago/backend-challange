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

## Fluxograma da rota /transfer 📜
![Fluxograma](https://cdn.discordapp.com/attachments/1106044734734090301/1254785651874856980/Flowchart.jpg?ex=667ac1b4&is=66797034&hm=2244f0e1311f213b1e637a2c783369e09fc242fd10ef7abe8616b61d0cd254c6&)
Link : https://miro.com/app/board/uXjVK4nECBE=/?share_link_id=186829003122
## Projetos pessoais usados como referência ✨

- Projeto em PHP para filtrar planos de telefone https://github.com/thetheago/CellphonePlans
- Projeto em Java da faculade sobre a apresentação do pattern Chain of Responsibility https://github.com/thetheago/Chain-of-Responsibility-Apresentation


## Nota pessoal ❤️

Apesar de não ter feito tudo que planejei, irei continuar dando continuidade neste projeto para fim de estudo e conclusão do próprio. Obrigado pela oportunidade de participar do desafio!
