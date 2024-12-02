# Tellover

**Tellover** é uma plataforma desenvolvida para auxiliar jogadores e narradores em aventuras de RPG. O sistema combina funcionalidades de redes sociais com ferramentas personalizadas para organizar narrativas, categorizar criaturas, gerenciar missões e calcular danos com base nos atributos dos personagens.

## Funcionalidades Principais

- **Gerenciamento de Categorias e Monstros**  
  Adicione e organize criaturas em categorias e subcategorias, como "Goblin Arqueiro" e "Goblin Guerreiro".

- **Registro do Histórico de Missões**  
  Registre e acompanhe missões realizadas, incluindo participantes e detalhes da narrativa.

- **Calculadora de Dano Personalizada**  
  Calcule danos com base em atributos como força, precisão e resistência.

- **Sistema de Papéis**  
  Defina papéis para os usuários: Player, Narrador e Administrador.

## Tecnologias Utilizadas

- **Framework:** Laravel  
- **Frontend:** Bootstrap 5  
- **Banco de Dados:** MySQL  
- **Outras Ferramentas:** Vite, Blade Templating  

## Como Executar o Projeto

1. Clone este repositório:  
   ```bash
   git clone https://github.com/seu-usuario/tellover.git
   ```

2. Acesse o diretório do projeto:  
   ```bash
   cd tellover
   ```

3. Instale as dependências:  
   ```bash
   composer install
   npm install
   ```

4. Configure o arquivo `.env`:  
   - Faça uma cópia do arquivo `.env.example` e renomeie para `.env`:  
     ```bash
     cp .env.example .env
     ```
   - Edite o `.env` e configure as informações do banco de dados:  
     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nome_do_banco
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```

5. Gere a chave da aplicação:  
   ```bash
   php artisan key:generate
   ```

6. Execute as migrações para criar as tabelas:  
   ```bash
   php artisan migrate
   ```

7. Inicie o servidor local:  
   ```bash
   php artisan serve
   npm run dev
   ```

8. Acesse a aplicação em: [http://localhost:8000](http://localhost:8000)

## Estrutura do Projeto

- `app/Models`: Modelos principais, como `User` e `Monstro`.  
- `resources/views`: Views para o frontend, incluindo modais e partials.  
- `database/migrations`: Estruturação das tabelas do banco de dados.
