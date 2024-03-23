package com.taniele.java_desktop.model;

public class Item implements Comparable<Item>{
    private String nome;
    private boolean concluido;
    private int prioridade;
    private long insercao;

    public Item(String nome){
        this.nome = nome;
        this.concluido = false;
        this.prioridade = 0;
    }

    public Item(String nome, int prioridade){
        this.nome = nome;
        this.concluido = false;
        this.prioridade = prioridade;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public boolean isConcluido() {
        return concluido;
    }

    public void setConcluido(boolean concluido) {
        this.concluido = concluido;
    }

    public int getPrioridade() {
        return prioridade;
    }

    public void setPrioridade(int prioridade) {
        this.prioridade = prioridade;
    }

    @Override
    public int compareTo(Item i) {
        int maiorPrioridade = Integer.compare(i.prioridade, this.prioridade);
        if (maiorPrioridade == 0) {
            // Se as prioridades forem iguais, ordena pela ordem de inserção (da mais antiga para a mais recente)
            return Long.compare(this.insercao, i.insercao);
        } else {
            return maiorPrioridade;
        }
    }
}
