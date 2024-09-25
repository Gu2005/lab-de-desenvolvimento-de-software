<form action="ClienteController" method="POST">
    <input type="hidden" name="id" value="${cliente.id}" />
    Nome: <input type="text" name="nome" value="${cliente.nome}" /><br/>
    CPF: <input type="text" name="cpf" value="${cliente.cpf}" /><br/>
    RG: <input type="text" name="rg" value="${cliente.rg}" /><br/>
    Endereço: <input type="text" name="endereco" value="${cliente.endereco}" /><br/>
    Profissão: <input type="text" name="profissao" value="${cliente.profissao}" /><br/>
    <input type="submit" value="Salvar" />
</form>
