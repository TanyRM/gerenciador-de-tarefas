package com.taniele.java_spring.services;

import com.taniele.java_spring.entity.Lista;
import com.taniele.java_spring.entity.Usuario;
import com.taniele.java_spring.repository.UsuarioRepository;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class UsuarioService {

    private final UsuarioRepository usuarioRepository;

    @Autowired
    public UsuarioService(UsuarioRepository usuarioRepository) {
        this.usuarioRepository = usuarioRepository;
    }

    public void adicionarLista(@NotNull Usuario usuario, Lista lista) {
        usuario.getListas().add(lista);
    }

    public void removerLista(@NotNull Usuario usuario, Lista lista) {
        usuario.getListas().remove(lista);
    }

    public void getLista(@NotNull Usuario usuario, Lista lista) {
        for (Lista l : usuario.getListas()) {
            if (l.getId() == lista.getId()) {
                lista = l;
            } else {
                System.out.println("Lista inexistente");
            }
        }
    }
}
