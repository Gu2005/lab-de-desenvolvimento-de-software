package controller;

import model.Cliente;
import model.ClienteDAO;

import javax.servlet.*;
import javax.servlet.http.*;
import java.io.IOException;

public class ClienteController extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String action = request.getParameter("action");
        ClienteDAO clienteDAO = new ClienteDAO();

        switch (action) {
            case "listar":
                request.setAttribute("clientes", clienteDAO.listarClientes());
                RequestDispatcher rd = request.getRequestDispatcher("/view/cliente/listar.jsp");
                rd.forward(request, response);
                break;

            case "editar":
                int id = Integer.parseInt(request.getParameter("id"));
                Cliente cliente = clienteDAO.getClienteById(id);
                request.setAttribute("cliente", cliente);
                rd = request.getRequestDispatcher("/view/cliente/editar.jsp");
                rd.forward(request, response);
                break;

            case "deletar":
                id = Integer.parseInt(request.getParameter("id"));
                clienteDAO.deletarCliente(id);
                response.sendRedirect("ClienteController?action=listar");
                break;

            default:
                response.sendRedirect("ClienteController?action=listar");
                break;
        }
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        ClienteDAO clienteDAO = new ClienteDAO();
        Cliente cliente = new Cliente();
        
        cliente.setNome(request.getParameter("nome"));
        cliente.setCpf(request.getParameter("cpf"));
        cliente.setRg(request.getParameter("rg"));
        cliente.setEndereco(request.getParameter("endereco"));
        cliente.setProfissao(request.getParameter("profissao"));
        
        String id = request.getParameter("id");
        if (id == null || id.isEmpty()) {
            clienteDAO.inserirCliente(cliente);
        } else {
            cliente.setId(Integer.parseInt(id));
            clienteDAO.atualizarCliente(cliente);
        }
        
        response.sendRedirect("ClienteController?action=listar");
    }
}
