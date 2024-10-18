<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
</head>
<body>
    <h1>Cadastro de Aluno</h1>
    <form action="views/processa_cadastro_aluno.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br><br>
        
        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" required><br><br>
        
        <label for="endereco">Endereço:</label>
        <textarea id="endereco" name="endereco" required></textarea><br><br>
        
        <label for="instituicao_id">ID da Instituição:</label>
        <input type="number" id="instituicao_id" name="instituicao_id" required><br><br>
        
        <label for="curso">Curso:</label>
        <input type="text" id="curso" name="curso" required><br><br>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>