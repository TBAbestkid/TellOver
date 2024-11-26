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
   ```
   git clone https://github.com/seu-usuario/tellover.git
   ```

2. Acesse o diretório do projeto:  
   ```
   cd tellover
   ```

3. Instale as dependências:  
   ```
   composer install
   npm install
   ```

4. Configure o arquivo `.env` com os detalhes do seu banco de dados.

5. Execute as migrações:  
   ```
   php artisan migrate
   ```

6. Inicie o servidor local:  
   ```
   php artisan serve
   npm run dev
   ```

7. Acesse em: [http://localhost:8000](http://localhost:8000)

## Estrutura do Projeto

- `app/Models`: Modelos principais, como `User` e `Monstro`.  
- `resources/views`: Views para o frontend, incluindo modais e partials.  
- `database/migrations`: Estruturação das tabelas do banco de dados.  

