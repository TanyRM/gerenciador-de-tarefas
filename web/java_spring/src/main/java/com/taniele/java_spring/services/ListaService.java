package com.taniele.java_spring.services;

import com.taniele.java_spring.entity.Item;
import com.taniele.java_spring.entity.Lista;
import com.taniele.java_spring.repository.ListaRepository;
import org.jetbrains.annotations.NotNull;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

@Service
public class ListaService {

    private final ListaRepository listaRepository;
    private final Logger logger = LoggerFactory.getLogger(UsuarioService.class);

    public ListaService(ListaRepository listaRepository) {
        this.listaRepository = listaRepository;
    }

    public void salvarNovaLista(@NotNull Lista lista) {
        listaRepository.save(lista);
        logger.info("Lista {} adicionada ao banco de dados", lista.getTitulo());
        System.out.println("Lista salva: " + lista.getTitulo());
    }

//    public void adicionarItem(@NotNull Lista lista, Item item) {
//        lista.getItens().add(item);
//    }
//
//    public void removerItem(@NotNull Lista lista, int indice) {
//        if (indice >= 0 && indice < lista.getItens().size()) {
//            lista.getItens().remove(indice);
//        }
//    }
}
