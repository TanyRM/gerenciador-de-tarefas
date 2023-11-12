package model;

import java.util.ArrayList;

public class Lista {
    private String titulo;
    private ArrayList<Item> itens;

    public Lista (String titulo){
        this.titulo = titulo;
        this.itens = new ArrayList<Item>();
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public ArrayList<Item> getItens() {
        return itens;
    }

    public void adicionarItem(Item item){
        this.itens.add(item);
    }

    public void excluirItem(Item item){
        this.itens.remove(item);
    }
}
