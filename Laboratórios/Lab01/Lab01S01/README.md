# Histórias de Usuários

## História de Usuário 1: Matrícula em Disciplinas

Como aluno,  
Quero me matricular em disciplinas obrigatórias e optativas,  
Para que eu possa planejar meu semestre de acordo com os requisitos do meu curso e minhas preferências pessoais.

Critérios de Aceitação:
- O sistema deve permitir a matrícula em até 4 disciplinas obrigatórias e 2 optativas.
- O sistema deve validar se a quantidade de disciplinas obrigatórias e optativas está dentro dos limites permitidos.
- O sistema deve notificar o aluno se alguma das disciplinas obrigatórias ou optativas estiver com o limite de vagas atingido.
- Após a matrícula, o sistema deve confirmar o sucesso da operação e informar o aluno sobre as disciplinas nas quais foi matriculado.

## História de Usuário 2: Cancelamento de Matrícula

Como aluno,  
Quero cancelar a matrícula em uma disciplina,  
Para que eu possa ajustar meu plano de semestre conforme necessário e liberar a vaga para outro aluno.

Critérios de Aceitação:
- O sistema deve permitir o cancelamento da matrícula em qualquer disciplina durante o período de matrículas.
- O sistema deve atualizar a disponibilidade de vagas na disciplina cancelada.
- O sistema deve notificar o aluno sobre o sucesso do cancelamento e atualizar o status da matrícula.

## História de Usuário 3: Verificação de Disciplinas Ativas

Como administrador do sistema,  
Quero verificar quais disciplinas têm pelo menos 3 alunos matriculados,  
Para que eu possa garantir que apenas as disciplinas com número mínimo de alunos sejam oferecidas no próximo semestre.

Critérios de Aceitação:
- O sistema deve gerar um relatório ou lista com disciplinas que têm pelo menos 3 alunos matriculados.
- O sistema deve incluir a opção de visualizar quais disciplinas foram canceladas devido à falta de alunos.
- O sistema deve permitir ao administrador ver a quantidade de alunos matriculados em cada disciplina.

## História de Usuário 4: Limite de Vagas em Disciplinas

Como aluno,  
Quero ser informado quando uma disciplina atingir o limite máximo de 60 vagas,  
Para que eu possa buscar outras opções de matrícula ou alternativas no meu planejamento.

Critérios de Aceitação:
- O sistema deve impedir novas matrículas quando uma disciplina atinge o limite de 60 alunos.
- O sistema deve notificar o aluno se a disciplina estiver cheia no momento da tentativa de matrícula.
- O sistema deve sugerir outras disciplinas ou opções se a escolha estiver indisponível.

## História de Usuário 5: Notificação ao Sistema de Cobranças

Como sistema de matrículas,  
Quero notificar automaticamente o sistema de cobranças após a matrícula de um aluno,  
Para que as taxas devidas pelas disciplinas sejam calculadas e cobradas corretamente.

Critérios de Aceitação:
- O sistema de matrículas deve enviar uma notificação ao sistema de cobranças assim que a matrícula for confirmada.
- O sistema de cobranças deve registrar a matrícula e calcular o valor total devido pelo aluno.
- O sistema deve gerar um recibo ou nota fiscal para o aluno após a matrícula.

## História de Usuário 6: Acesso de Professores

Como professor,  
Quero acessar a lista de alunos matriculados em minhas disciplinas,  
Para que eu possa planejar e gerenciar minhas aulas de acordo com o número de alunos.

Critérios de Aceitação:
- O sistema deve permitir ao professor acessar uma lista atualizada de alunos matriculados em suas disciplinas.
- O sistema deve garantir que o acesso seja restrito apenas às disciplinas que o professor leciona.
- O sistema deve permitir ao professor visualizar detalhes básicos dos alunos, como nome e identificação.

## História de Usuário 7: Autenticação de Usuários

Como usuário do sistema (aluno, professor ou administrador),  
Quero realizar o login usando uma senha,  
Para que eu possa acessar minhas informações e realizar operações autorizadas com segurança.

Critérios de Aceitação:
- O sistema deve exigir uma senha para autenticação de qualquer usuário.
- O sistema deve permitir a recuperação ou reset da senha em caso de esquecimento.
- O sistema deve garantir a segurança e confidencialidade das senhas.

Essas histórias de usuário ajudam a definir os requisitos e comportamentos esperados para o sistema de matrículas, garantindo que ele atenda às necessidades de alunos, professores e administradores. 

# Diagrama de Caso de Uso v.1

![Diagrama Caso de Uso v.1](..\Laboratórios\Lab01\Lab01S01\DiagramaCasoDeUsoV1.jpg)

