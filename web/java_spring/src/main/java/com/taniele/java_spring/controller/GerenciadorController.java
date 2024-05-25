package com.taniele.java_spring.controller;

import com.taniele.java_spring.entity.Usuario;
import com.taniele.java_spring.repository.UsuarioRepository;
import com.taniele.java_spring.services.GerenciadorService;
import com.taniele.java_spring.services.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.*;

@Controller
public class GerenciadorController {

    private final GerenciadorService gerenciadorService;

    @Autowired
    public GerenciadorController(GerenciadorService gerenciadorService) {
        this.gerenciadorService = gerenciadorService;
    }

    @GetMapping("/")
    public String home() {
        return "index";  // Redireciona para a pagina index.html que está em templates
    }

    @GetMapping("/login")
    public String login() {
        return "login";
    }

    @GetMapping("/cadastro")
    public String cadastro(Model model) {
        model.addAttribute("usuarioForm", new Usuario());
        return "cadastro";
    }

    @PostMapping("/cadastro")
    @ResponseStatus(code = HttpStatus.CREATED)
    public String cadastrar(@ModelAttribute("usuarioForm") Usuario usuario) {
        System.out.println("Iniciando o método cadastrar");
        System.out.println("Nome: " + usuario.getNome());
        System.out.println("Email: " + usuario.getEmail());
        System.out.println("Senha: " + usuario.getSenha());

        gerenciadorService.salvarNovoUsuario(usuario);
        System.out.println("Usuário salvo com sucesso");

        return "/login";
    }
}

