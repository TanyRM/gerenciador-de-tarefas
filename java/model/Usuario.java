package model;

import java.util.ArrayList;

public class Usuario {
    private String nome;
    private String email;
    private String senha;
    private ArrayList<Lista> listas;

    public Usuario(String email, String nome, String senha) {
        this.email = email;
        this.nome = nome;
        this.senha = senha;
        this.listas = new ArrayList<Lista>();
    }

    public String getNome() {
        return nome;
    }

    public String getSenha() {
        return senha;
    }

    public ArrayList<Lista> getListas() {
        return listas;
    }

    public void setListas(ArrayList<Lista> listas) {
        this.listas = listas;
    }

    public void adicionarLista(Lista lista) {
        this.listas.add(lista);
    }

    public int getIndiceLista(String titulo) {
        for (int indice = 0; indice < listas.size(); indice++) {
            Lista lista = listas.get(indice);
            if (lista.getTitulo().equals(titulo)) {
                return indice;
            }
        }
        return -1; // Retorna -1 se a lista não for encontrada
    }

    public void excluirLista(Lista lista) {
        int indice = this.getIndiceLista(lista.getTitulo());
        if (indice != -1) {
            listas.subList(indice, indice + 1).clear();
        }
    }
}
