package com.taniele.java_desktop.model;

import java.util.ArrayList;
import java.util.List;

public class Gerenciador {
    private List<Usuario> usuarios;

    public Gerenciador(){
        this.usuarios = new ArrayList<>();
    }

    public boolean validarDados(String nome, String senha){
        for (Usuario u: usuarios){
            if (u.getNome().equals(nome) && u.getSenha().equals(senha)){
                return true;
            }
        }
        return false;
    }

    public void adicionarUsuario(Usuario usuario){
        this.usuarios.add(usuario);
    }

    public Usuario getUsuario(String nome){
        for (Usuario u: usuarios){
            if (u.getNome().equals(nome)){
                return u;
            }
        }
        return null;
    }
}
