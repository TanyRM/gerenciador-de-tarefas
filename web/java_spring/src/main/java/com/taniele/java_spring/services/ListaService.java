package com.taniele.java_spring.services;

import com.taniele.java_spring.entity.Item;
import com.taniele.java_spring.entity.Lista;
import org.jetbrains.annotations.NotNull;
import org.springframework.stereotype.Service;

@Service
public class ListaService {

    public void adicionarItem(@NotNull Lista lista, Item item) {
        lista.getItens().add(item);
    }

    public void removerItem(@NotNull Lista lista, int indice) {
        if (indice >= 0 && indice < lista.getItens().size()) {
            lista.getItens().remove(indice);
        }
    }
}
