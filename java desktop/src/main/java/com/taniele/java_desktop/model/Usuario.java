package com.taniele.java_desktop.model;

import java.util.ArrayList;
import java.util.List;

public class Usuario {
    private String nome;
    private final String email;
    private String senha;
    private List<Lista> listas;

    public Usuario(String nome, String email, String senha) {
        this.nome = nome;
        this.email = email;
        this.senha = senha;
        this.listas = new ArrayList<>();
    }

    public String getNome() {
        return nome;
    }

    public String getSenha() {
        return senha;
    }

    public List<Lista> getListas() {
        return listas;
    }

    public void adicionarLista(Lista lista){
        listas.add(lista);
    }

    private int getIndice(String titulo) {
        for (int indice = 0; indice < listas.size(); indice++) {
            // Verifica se o titulo da lista armazenada em cada item é igual ao buscado
            if (listas.get(indice).getTitulo().equals(titulo)) {
                return indice;
            }
        }
        return -1;
    }
    public void excluirLista(@org.jetbrains.annotations.NotNull Lista lista){
        int indice = this.getIndice(lista.getTitulo());
        if (indice != -1){
            listas.remove(indice);
        }
    }
}
