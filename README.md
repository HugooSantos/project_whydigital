<div align="center">
 <h1> Projeto Why Digital</h1>
</div>

- Clone o projeto (caso você esteja usando windows, pelo wsl 2):

```
git clone https://github.com/HugooSantos/project_whydigital.git ; cd project_whydigital
```
- Dentro da pasta project_whydigital vamos copiar o .env.example do laravel e já fazer as alterações necessárias:

```
cp ./backend/env.example .backend/env
```

- Vamos usar o docker e o docker compose como ambiente de desenvolvimento/teste, caso não o tenha instalado você pode baixa-los por aqui (caso a sua distro não seja debian você pode mudar a esquerda para sua distro):
- [docker](https://docs.docker.com/engine/install/debian/) 
- [docker-compose](https://docs.docker.com/compose/install/) 

- Vamos dar permissão ao comando sh e executa-lo para subir os containers :

- Primeiro:

```
sudo chmod 755 runProject.sh
```

- Segundo:

```
./runProject.sh 
```

- Esse processo pode demorar um pouco, então que tal já irmos importando a sua colection do postman? 

> Collection : [Collection](https://drive.google.com/uc?export=download&id=1ih6jmuBWi3DKKvuozR78kqxpVBdB9OTp) 

> Env : [env](https://drive.google.com/uc?export=download&id=1K5XAz-GAgayhIwF-l35IPxvTKAk3ILOG)


- Lembre de colocar o env do seu postman para facilitar o processo de teste:

<br>
<div align="center">
  <img alt="env postman" src="./envpostman.png" width="700px"/>
</div>
<br>


- Para executar os testes você pode rodar o sh que já deixei pronto pra isso, primeiro iremos dar permissão e depois você pode executar:

- Primeiro:

```
sudo chmod 755 runTests.sh
```

- Segundo:

```
./runTests.sh 
```

- Aqui temos a tela de login no qual você precisara de um usuário pra acessar:

<br>
<div align="center">
  <img alt="login page" src="./loginScreen.png" width="700px"/>
</div>
<br>

- Deixei alguns usuários já salvos no banco para uso, eles são:

```
email: eduardo@whydigital.com
password: 12345678
```

```
email: bruno@whydigital.com
password: 12345678
```

```
email: hugo@whydigital.com
password: 12345678
```