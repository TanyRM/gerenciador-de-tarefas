package com.taniele.java_spring.controller;

import com.taniele.java_spring.repository.UsuarioRepository;
import com.taniele.java_spring.services.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class UsuarioController {

    @Autowired
    private UsuarioService usuarioService;
    @Autowired
    private UsuarioRepository usuarioRepository;

    @GetMapping("/pagina_inicial")
    public String paginaInicial() {
        return "/pagina_inicial";
    }
}
