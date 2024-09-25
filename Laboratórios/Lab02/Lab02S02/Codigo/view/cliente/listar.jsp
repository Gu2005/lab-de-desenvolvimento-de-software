<h2>Lista de Clientes</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>RG</th>
        <th>Endereço</th>
        <th>Profissão</th>
        <th>Ações</th>
    </tr>
    <c:forEach var="cliente" items="${clientes}">
        <tr>
            <td>${cliente.id}</td>
            <td>${cliente.nome}</td>
            <td>${cliente.cpf}</td>
            <td>${cliente.rg}</td>
            <td>${cliente.endereco}</td>
            <td>${cliente.profissao}</td>
            <td>
                <a href="ClienteController?action=editar&id=${cliente.id}">Editar</a>
                <a href="ClienteController?action=deletar&id=${cliente.id}">Deletar</a>
            </td>
        </tr>
    </c:forEach>
</table>
<a href="cadastro.jsp">Cadastrar Novo Cliente</a>
