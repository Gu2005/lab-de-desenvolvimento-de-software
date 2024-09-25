package model;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import config.Conexao;

public class ClienteDAO {
    private Connection conn;

    public ClienteDAO() {
        this.conn = Conexao.getConnection();
    }

    // CREATE
    public void inserirCliente(Cliente cliente) {
        String sql = "INSERT INTO cliente (nome, cpf, rg, endereco, profissao) VALUES (?, ?, ?, ?, ?)";
        try {
            PreparedStatement stmt = conn.prepareStatement(sql);
            stmt.setString(1, cliente.getNome());
            stmt.setString(2, cliente.getCpf());
            stmt.setString(3, cliente.getRg());
            stmt.setString(4, cliente.getEndereco());
            stmt.setString(5, cliente.getProfissao());
            stmt.execute();
            stmt.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // READ
    public List<Cliente> listarClientes() {
        List<Cliente> clientes = new ArrayList<>();
        String sql = "SELECT * FROM cliente";
        try {
            Statement stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(sql);
            while (rs.next()) {
                Cliente cliente = new Cliente(
                    rs.getInt("id"),
                    rs.getString("nome"),
                    rs.getString("cpf"),
                    rs.getString("rg"),
                    rs.getString("endereco"),
                    rs.getString("profissao")
                );
                clientes.add(cliente);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return clientes;
    }

    // UPDATE
    public void atualizarCliente(Cliente cliente) {
        String sql = "UPDATE cliente SET nome=?, cpf=?, rg=?, endereco=?, profissao=? WHERE id=?";
        try {
            PreparedStatement stmt = conn.prepareStatement(sql);
            stmt.setString(1, cliente.getNome());
            stmt.setString(2, cliente.getCpf());
            stmt.setString(3, cliente.getRg());
            stmt.setString(4, cliente.getEndereco());
            stmt.setString(5, cliente.getProfissao());
            stmt.setInt(6, cliente.getId());
            stmt.execute();
            stmt.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // DELETE
    public void deletarCliente(int id) {
        String sql = "DELETE FROM cliente WHERE id=?";
        try {
            PreparedStatement stmt = conn.prepareStatement(sql);
            stmt.setInt(1, id);
            stmt.execute();
            stmt.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // GET BY ID
    public Cliente getClienteById(int id) {
        Cliente cliente = null;
        String sql = "SELECT * FROM cliente WHERE id=?";
        try {
            PreparedStatement stmt = conn.prepareStatement(sql);
            stmt.setInt(1, id);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                cliente = new Cliente(
                    rs.getInt("id"),
                    rs.getString("nome"),
                    rs.getString("cpf"),
                    rs.getString("rg"),
                    rs.getString("endereco"),
                    rs.getString("profissao")
                );
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return cliente;
    }
}
