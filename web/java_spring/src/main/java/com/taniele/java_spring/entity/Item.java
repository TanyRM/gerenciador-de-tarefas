package com.taniele.java_spring.entity;

import jakarta.persistence.*;

@Entity
public class Item {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    @Column(nullable = false)
    private String nome;
    @Column
    private Boolean concluido;
    @Column(nullable = true)
    private int prioridade;

    public Item() {}

    public Item(String nome, int prioridade) {
        this.nome = nome;
        this.prioridade = prioridade;
        this.concluido = false;
    }

    public Item(String nome) {
        this.nome = nome;
        this.concluido = false;
        this.prioridade = 0;
    }

    // uso de lombok para getters e setters
}