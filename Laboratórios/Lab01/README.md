<img width=100% src="https://capsule-render.vercel.app/api?type=waving&color=09738a&height=120&section=header"/>

<h1 align="center">
    <br> Sistema de Matrículas
</h1>

## Contextualização

Este projeto visa desenvolver um Sistema de Matrículas para informatizar a gestão acadêmica da universidade, permitindo o gerenciamento de cursos, disciplinas, professores e alunos, além da realização e cancelamento de matrículas pelos alunos dentro de períodos específicos.

##  Objetivo do Projeto

O sistema permitirá que a secretaria da universidade administre as disciplinas, cursos, professores e alunos, enquanto os alunos poderão efetuar e cancelar matrículas durante períodos determinados. O controle de número mínimo e máximo de alunos por disciplina será gerenciado, e o sistema se integrará ao sistema de cobranças da universidade. Professores poderão consultar a lista de alunos matriculados em suas disciplinas.

## Linguagem e Arquiteturas

O sistema será desenvolvido em PHP utilizando a arquitetura MVC, e dividido em três sprints, com entregas de modelagem UML, prototipagem e atualizações do sistema.

## Instruções de Uso

### Passo a Passo

1. **Instale o XAMPP**:
   - Baixe e instale o XAMPP a partir do [site oficial](https://www.apachefriends.org/index.html).
   - Certifique-se de que o Apache e MySQL estão ativos no painel de controle do XAMPP.

2. **Copie o código para o diretório do XAMPP**:
   - Extraia o código do projeto (já fiz isso) e copie a pasta **Códigos** para o diretório de projetos do XAMPP:
     - Caminho padrão no Windows: `C:\xampp\htdocs\`
     - Caminho padrão no Linux/macOS: `/opt/lampp/htdocs/`
   - O caminho final será algo como: `C:\xampp\htdocs\Códigos`.

3. **Configuração do banco de dados MySQL**:
   - No XAMPP, clique em **MySQL Admin** para abrir o phpMyAdmin.
   - No phpMyAdmin, crie um banco de dados que será usado pelo seu sistema. Você pode usar o nome que preferir, como `sistema_escolar`.
   - Importe o arquivo de banco de dados localizado na pasta `bd-mysql` para este banco criado.

4. **Configuração do sistema**:
   - Abra o arquivo de configuração da conexão com o banco de dados na pasta **config**, e edite as credenciais para se conectar ao banco de dados que você criou. O arquivo provavelmente se chamará algo como `config.php`.
   - Defina o host, usuário, senha e nome do banco de dados corretamente:
     ```php
     $host = 'localhost';
     $db_name = 'sistema_escolar';
     $username = 'root';  // usuário padrão do XAMPP
     $password = '';  // senha padrão do XAMPP (normalmente vazia)
     ```

5. **Acesse o sistema**:
   - No navegador, digite `http://localhost/Códigos/` para acessar o sistema PHP rodando localmente no XAMPP.

Isso deve ser suficiente para rodar o código PHP e fazer a integração com o MySQL.

## Divisão das Sprints

* [Sprint 01](../Lab01/Lab01S01/)

* [Sprint 02](../Lab01/Lab01S02/)

* [Sprint 03](../Lab01/Lab01S03/)


<img width=100% src="https://capsule-render.vercel.app/api?type=waving&color=09738a&height=120&section=footer"/>