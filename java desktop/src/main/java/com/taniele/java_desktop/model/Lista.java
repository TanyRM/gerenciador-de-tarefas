package com.taniele.java_desktop.model;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public class Lista {
    private String titulo;
    private List<Item> itens;

    public Lista(String titulo) {
        this.titulo = titulo;
        this.itens = new ArrayList<>();
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public List<Item> getItens() {
        return itens;
    }

    public void adicionarItem(Item item){
        itens.add(item);
        Collections.sort(itens);
    }

    public void excluirItem(int indice){
        if (indice >= 0 && indice < itens.size()) {
            itens.remove(indice);
        }
    }
}
