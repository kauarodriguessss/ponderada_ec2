# Aplicação Web com AWS EC2, MySQL, PHP e Apache

Este repositório contém o código-fonte e a documentação de uma aplicação web desenvolvida como parte de uma atividade ponderada. A aplicação permite o gerenciamento de funcionários através de uma interface web, armazenando e recuperando dados de um banco de dados MySQL hospedado em uma instância EC2 da AWS.

## Descrição do Projeto

O projeto consiste em uma aplicação web para cadastro e visualização de funcionários, com as seguintes funcionalidades:

- Cadastro de funcionários (nome, endereço, idade e data de admissão)
- Visualização dos funcionários cadastrados
- Armazenamento persistente dos dados em um banco de dados MySQL
- Interface de usuário responsiva e intuitiva

### Tecnologias Utilizadas
- **AWS EC2**: Para hospedar a aplicação web
- **Amazon RDS (MySQL)**: Como sistema de gerenciamento de banco de dados
- **PHP**: Para a lógica de backend e interação com o banco de dados
- **Apache**: Como servidor web para servir a aplicação
- **HTML/CSS**: Para a interface do usuário

## Estrutura do Repositório

- `index.php`: Arquivo principal da aplicação, contendo o código PHP para interação com o banco de dados e a interface de usuário
- `inc/dbinfo.inc`: Arquivo de configuração com as credenciais do banco de dados (**não incluído no repositório por segurança**)

## Estrutura do Banco de Dados

A aplicação utiliza uma única tabela:

### Tabela EMPLOYEES
- `ID`: Identificador único (**chave primária**)
- `NAME`: Nome do funcionário
- `ADDRESS`: Endereço do funcionário
- `AGE`: Idade do funcionário
- `JOIN_DATE`: Data de admissão do funcionário

## Interface do Usuário

A aplicação possui uma interface moderna e organizada, com os seguintes aspectos:

- Design responsivo para melhor usabilidade em diferentes dispositivos
- Formulários organizados e campos validados
- Tabelas formatadas para facilitar a leitura dos dados
- Mensagens de feedback para ações do usuário
- Estilização com CSS para uma experiência visual mais agradável

## Configuração do Ambiente

### Pré-requisitos
- Conta AWS
- Conhecimentos básicos de EC2, MySQL, PHP e Apache

### Passos para Configuração

#### 1. Criando a Instância EC2
- Acesse o console da AWS e crie uma instância EC2
- Escolha uma AMI compatível com PHP e Apache
- Configure os grupos de segurança para permitir tráfego HTTP (porta 80) e MySQL (porta 3306)
- Gere e baixe um par de chaves para acesso SSH

#### 2. Instalando e Configurando o MySQL
- Conecte-se à instância EC2 via SSH
- Instale o MySQL Server
- Configure um usuário e senha para o banco de dados
- Crie um banco de dados chamado `employees_db`

#### 3. Configuração do Apache e PHP
- Instale o Apache e o PHP na instância EC2
- Configure o Apache para servir arquivos PHP
- Reinicie o serviço Apache

#### 4. Implantação da Aplicação
- Clone este repositório na instância EC2
- Crie o arquivo `inc/dbinfo.inc` com as credenciais do banco de dados
- Movimente os arquivos para o diretório raiz do Apache (`/var/www/html/`)

## Uso da Aplicação

1. **Acesse a aplicação** através do endereço IP público da instância EC2.
2. **Cadastro de Funcionários:**
   - Preencha o formulário com os dados do funcionário
   - Clique em "Adicionar Funcionário"
   - Visualize os funcionários cadastrados na tabela abaixo

## Segurança

Para garantir a segurança da aplicação:
- O arquivo de configuração com as credenciais do banco de dados **não** está incluído no repositório.
- A aplicação utiliza `mysqli_real_escape_string` para prevenir ataques de SQL Injection.
- Os dados do formulário são sanitizados antes de serem inseridos no banco de dados.
- Validação de tipos de dados para evitar inserções inválidas.

## Vídeo Explicativo

Para uma explicação detalhada sobre o desenvolvimento e funcionamento deste projeto, assista ao vídeo explicativo através do link abaixo:

[Vídeo Explicativo](https://drive.google.com/file/d/1LepcykdivYpyR6B4djnAX4Ps5ITKTYmV/view?usp=sharing)

## Autor
Kauã Rodrigues dos Santos

## Licença
Este projeto está licenciado sob a **licença MIT** - veja o arquivo LICENSE para mais detalhes.
