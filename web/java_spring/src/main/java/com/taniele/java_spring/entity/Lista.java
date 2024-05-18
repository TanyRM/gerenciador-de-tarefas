package com.taniele.java_spring.entity;

import jakarta.persistence.*;

import java.util.ArrayList;
import java.util.List;

@Entity
public class Lista {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    @Column(nullable = false)
    private String nome;;
    @Column(nullable = true)
    private String descricao;
    @OneToMany
    private List<Item> itens;

    public Lista() {}

    public Lista(String nome, String descricao) {
        this.nome = nome;
        this.descricao = descricao;
        this.itens = new ArrayList<Item>();
    }

    public Lista(String nome) {
        this.nome = nome;
        this.descricao = null;
        this.itens = new ArrayList<Item>();
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public List<Item> getItens() {
        return itens;
    }

    public void setItens(List<Item> itens) {
        this.itens = itens;
    }
}
