package com.taniele.java_spring.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class GerenciadorController {

    @GetMapping("/")
    public String home() {
        return "index";  // Redireciona para a pagina index.html que está em templates
    }

    @GetMapping("/login")
    public String login() {
        return "login";
    }

    @GetMapping("/cadastro")
    public String cadastro() {
        return "cadastro";
    }
}

