<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_universidade";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Adiciona a funcionalidade de visualização da grade de horário ao selecionar um curso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = $_POST['tipo'];
    $curso_id = isset($_POST['curso_id']) ? $_POST['curso_id'] : NULL;

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo, curso_id) VALUES ('$nome', '$email', '$senha', '$tipo', $curso_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #2c3e50;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .grade-horario {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .grade-horario h2 {
            color: #2c3e50;
        }
        .grade-horario h3 {
            color: #34495e;
        }
        .grade-horario ul {
            list-style-type: none;
            padding: 0;
        }
        .grade-horario li {
            background-color: #ecf0f1;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>Cadastro</h2>
    <form action="../controllers/cadastro_controller.php" method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        
        <select name="tipo" id="tipo" onchange="toggleCurso()" required>
            <option value="">Selecione o Tipo</option>
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
            <option value="secretario">Secretário</option>
        </select>

        <div id="cursoDiv" style="display: none;">
            <select name="curso_id" id="curso_id" onchange="showGrade()">
                <option value="">Selecione o Curso</option>
                <option value="1">Engenharia de Software</option>
                <option value="2">Ciência da Computação</option>
            </select>
        </div>

        <button type="submit">Cadastrar</button>
    </form>

    <div id="grade-horario-es" class="grade-horario">
        <h2>Grade de Horário - Engenharia de Software</h2>
        <div>
            <h3>1º Período</h3>
            <ul>
                <li>Cálculo Diferencial e Integral I (4 créditos) - R$ 400,00</li>
                <li>Fundamentos de Programação (4 créditos) - R$ 400,00</li>
                <li>Introdução à Engenharia de Software (4 créditos) - R$ 400,00</li>
                <li>Lógica Matemática (3 créditos) (optativa) - R$ 300,00</li>
                <li>Álgebra Linear (3 créditos) (optativa) - R$ 300,00</li>
                <li>Comunicação e Expressão (2 créditos) (optativa) - R$ 200,00</li>
            </ul>
            <h3>2º Período</h3>
            <ul>
                <li>Cálculo Diferencial e Integral II (4 créditos) - R$ 400,00</li>
                <li>Estruturas de Dados (4 créditos) (optativa) - R$ 400,00</li>
                <li>Engenharia de Requisitos (4 créditos) - R$ 400,00</li>
                <li>Probabilidade e Estatística (3 créditos) (optativa) - R$ 300,00</li>
                <li>Matemática Discreta (3 créditos) (optativa) - R$ 300,00</li>
                <li>Fundamentos de Banco de Dados (3 créditos) - R$ 300,00</li>
            </ul>
            <h3>3º Período</h3>
            <ul>
                <li>Programação Orientada a Objetos (4 créditos) - R$ 400,00</li>
                <li>Engenharia de Software I (4 créditos) (optativa) - R$ 400,00</li>
                <li>Sistemas Operacionais (4 créditos) - R$ 400,00</li>
                <li>Algoritmos Avançados (4 créditos) - R$ 400,00</li>
                <li>Banco de Dados II (3 créditos) - R$ 300,00</li>
                <li>Gestão de Projetos de Software (3 créditos) - R$ 300,00</li>
            </ul>
        </div>
    </div>

    <div id="grade-horario-cc" class="grade-horario">
        <h2>Grade de Horário - Ciência da Computação</h2>
        <div>
            <h3>1º Período</h3>
            <ul>
                <li>Cálculo Diferencial e Integral I (4 créditos) (optativa) - R$ 400,00</li>
                <li>Fundamentos de Programação (4 créditos) - R$ 400,00</li>
                <li>Lógica para Computação (4 créditos) - R$ 400,00</li>
                <li>Álgebra Linear (3 créditos) (optativa) - R$ 300,00</li>
                <li>Introdução à Ciência da Computação (3 créditos) - R$ 300,00</li>
                <li>Comunicação e Expressão (2 créditos) (optativa) - R$ 200,00</li>
            </ul>
            <h3>2º Período</h3>
            <ul>
                <li>Cálculo Diferencial e Integral II (4 créditos) - R$ 400,00</li>
                <li>Estruturas de Dados (4 créditos) - R$ 400,00</li>
                <li>Arquitetura de Computadores (4 créditos) - R$ 400,00</li>
                <li>Matemática Discreta (3 créditos) (optativa) - R$ 300,00</li>
                <li>Probabilidade e Estatística (3 créditos) (optativa) - R$ 300,00</li>
                <li>Teoria dos Grafos (3 créditos) (optativa) - R$ 300,00</li>
            </ul>
            <h3>3º Período</h3>
            <ul>
                <li>Programação Orientada a Objetos (4 créditos) - R$ 400,00</li>
                <li>Algoritmos Avançados (4 créditos) - R$ 400,00</li>
                <li>Sistemas Operacionais (4 créditos) (optativa) - R$ 400,00</li>
                <li>Redes de Computadores (4 créditos) (optativa) - R$ 400,00</li>
                <li>Banco de Dados I (3 créditos) - R$ 300,00</li>
                <li>Fundamentos de Inteligência Artificial (3 créditos) (optativa) - R$ 300,00</li>
            </ul>
        </div>
    </div>

    <script>
        function toggleCurso() {
            const tipo = document.getElementById('tipo').value;
            const cursoDiv = document.getElementById('cursoDiv');
            cursoDiv.style.display = tipo === 'aluno' ? 'block' : 'none';
            hideGrade();
        }

        function showGrade() {
            const curso_id = document.getElementById('curso_id').value;
            const gradeEs = document.getElementById('grade-horario-es');
            const gradeCc = document.getElementById('grade-horario-cc');
            if (curso_id == '1') { // Engenharia de Software
                gradeEs.style.display = 'block';
                gradeCc.style.display = 'none';
            } else if (curso_id == '2') { // Ciência da Computação
                gradeEs.style.display = 'none';
                gradeCc.style.display = 'block';
            } else {
                hideGrade();
            }
        }

        function hideGrade() {
            const gradeEs = document.getElementById('grade-horario-es');
            const gradeCc = document.getElementById('grade-horario-cc');
            gradeEs.style.display = 'none';
            gradeCc.style.display = 'none';
        }
    </script>
</body>
</html>