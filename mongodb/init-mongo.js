const db = db.getSiblingDB('payment');

db.createCollection('users');
db.users.createIndex(
  { cpf: 1, email: 1 },
  { unique: true }
);

db.users.insertMany([
    {
        id: 1,
        name: "Thiago Skinner",
        email: "theago.dev@gmail.com",
        cpf: "123.456.789-10",
        shopkeeper: true,
        amount: 300.00
    },
    {
        id: 4,
        name: "Tyler Joseph",
        email: "tyler@gmail.com",
        cpf: "987.654.312-01",
        shopkeeper: false,
        amount: 620.20
    },
    {
        id: 15,
        name: "Josh Dun",
        email: "josh@gmail.com",
        cpf: "111.222.333-44",
        shopkeeper: false,
        amount: 132.06
    },
]);
