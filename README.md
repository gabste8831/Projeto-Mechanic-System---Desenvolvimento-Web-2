# Sistema de Gerenciamento de Mecânicos e Carros

Sistema web desenvolvido em Laravel para gerenciamento de oficina mecânica, permitindo o controle de mecânicos e carros.

## 🚀 Funcionalidades

### ✅ Implementadas

-   **CRUD Completo para Mecânicos**

    -   Cadastro, listagem, edição e remoção de mecânicos
    -   Busca por nome, email ou especialidade
    -   Controle de disponibilidade

-   **CRUD Completo para Carros**

    -   Registro, listagem, edição e remoção de carros
    -   Busca por marca, modelo ou placa
    -   Filtro por status (Pendente, Em Andamento, Concluído)

-   **Relacionamento entre Tabelas**

    -   Mecânicos podem ser atribuídos a carros
    -   Visualização de carros por mecânico
    -   Contagem de carros por mecânico

-   **Sistema de Busca e Filtros**

    -   Busca textual em mecânicos e carros
    -   Filtros por status de carros
    -   Paginação dos resultados

-   **Interface Moderna**

    -   Design responsivo com Tailwind CSS
    -   Tema em tons de cinza
    -   Componentes reutilizáveis
    -   Ícones e elementos visuais

-   **Navegação Intuitiva**

    -   Menu de navegação principal
    -   Breadcrumbs e botões de ação
    -   Dashboard com estatísticas

-   **Templates Reutilizáveis**

    -   Layout principal com componentes
    -   Formulários padronizados
    -   Cards e botões consistentes

-   **Autenticação de Usuários**
    -   Sistema de login/registro
    -   Proteção de rotas
    -   Controle de sessão

## 🛠️ Tecnologias Utilizadas

-   **Backend**: Laravel 12
-   **Frontend**: Tailwind CSS
-   **Banco de Dados**: SQLite
-   **Autenticação**: Laravel UI
-   **Validação**: Laravel Validation
-   **Paginação**: Laravel Pagination

## 📋 Requisitos do Sistema

-   PHP 8.1 ou superior
-   Composer
-   Node.js e NPM (para compilação de assets)

## 🚀 Instalação

1. **Clone o repositório**

    ```bash
    git clone <url-do-repositorio>
    cd mechanic-system
    ```

2. **Instale as dependências do PHP**

    ```bash
    composer install
    ```

3. **Configure o ambiente**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure o banco de dados**

    ```bash
    # Para SQLite (padrão)
    touch database/database.sqlite
    ```

5. **Execute as migrações**

    ```bash
    php artisan migrate
    ```

6. **Execute os seeders (dados de exemplo)**

    ```bash
    php artisan db:seed
    ```

7. **Instale as dependências do Node.js**

    ```bash
    npm install
    ```

8. **Compile os assets**

    ```bash
    npm run dev
    ```

9. **Inicie o servidor**
    ```bash
    php artisan serve
    ```

## 📊 Estrutura do Banco de Dados

### Tabela: mechanics

-   `id` - Chave primária
-   `name` - Nome do mecânico
-   `email` - Email único
-   `phone` - Telefone
-   `specialty` - Especialidade
-   `experience_years` - Anos de experiência
-   `is_available` - Status de disponibilidade
-   `created_at` / `updated_at` - Timestamps

### Tabela: cars

-   `id` - Chave primária
-   `brand` - Marca do carro
-   `model` - Modelo do carro
-   `year` - Ano do carro
-   `license_plate` - Placa única
-   `color` - Cor do carro
-   `problem_description` - Descrição do problema
-   `status` - Status (pending, in_progress, completed)
-   `mechanic_id` - Chave estrangeira para mecânico
-   `created_at` / `updated_at` - Timestamps

## 🎯 Funcionalidades por Requisito

| Requisito                    | Status | Implementação             |
| ---------------------------- | ------ | ------------------------- |
| Laravel + Banco de Dados     | ✅     | Laravel 12 + SQLite       |
| CRUD 2 tabelas               | ✅     | Mecânicos e Carros        |
| Relacionamento entre tabelas | ✅     | Mecânicos ↔ Carros        |
| Busca e Filtros              | ✅     | Busca textual + filtros   |
| Menu de navegação            | ✅     | Menu principal responsivo |
| Layout atraente              | ✅     | Tailwind CSS + tema cinza |
| Templates reutilizáveis      | ✅     | Layout e componentes      |
| Autenticação                 | ✅     | Laravel UI Auth           |

## 👤 Usuário Padrão

Após executar os seeders, você pode fazer login com:

-   **Email**: test@example.com
-   **Senha**: password

## 📱 Telas do Sistema

1. **Dashboard** - Visão geral com estatísticas
2. **Mecânicos** - Listagem e gerenciamento
3. **Carros** - Listagem e gerenciamento
4. **Formulários** - Cadastro e edição
5. **Detalhes** - Visualização completa

## 🔧 Comandos Úteis

```bash
# Limpar cache
php artisan cache:clear

# Limpar configurações
php artisan config:clear

# Recriar banco de dados
php artisan migrate:fresh --seed

# Gerar nova chave
php artisan key:generate
```

## 📝 Licença

Este projeto foi desenvolvido como atividade acadêmica para a disciplina de Programação Web 2.

## 👨‍💻 Desenvolvedor

Desenvolvido como atividade individual para demonstração dos conceitos de MVC, Laravel e banco de dados.
