package controller;

import model.Usuario;

import java.util.ArrayList;

public class Gerenciador {
    private ArrayList<Usuario> usuarios;

    public Gerenciador() {
        this.usuarios = new ArrayList<Usuario>();
    }

    public boolean validarDados(String nome, String senha) {
        for (Usuario usuario : usuarios){
            if ((nome.equals(usuario.getNome())) && (senha.equals(usuario.getSenha()))) {
                return true;
            }
        }
        return false;
    }

    public void adicionarUsuario(Usuario usuario) {
        this.usuarios.add(usuario);
    }

    public Usuario getUsuario(String nome) {
        for (Usuario usuario : usuarios) {
            if (usuario.getNome().equals(nome)) {
                return usuario;
            }
        }
        return null;
    }
}
