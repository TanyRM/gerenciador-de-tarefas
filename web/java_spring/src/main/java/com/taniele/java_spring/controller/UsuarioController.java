package com.taniele.java_spring.controller;

import com.taniele.java_spring.entity.Usuario;
import com.taniele.java_spring.repository.UsuarioRepository;
import com.taniele.java_spring.services.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

@Controller
public class UsuarioController {

    @Autowired
    private UsuarioService usuarioService;
    @Autowired
    private UsuarioRepository usuarioRepository;

    @RequestMapping("/login-success")
    public String loginSuccess(RedirectAttributes redirectAttributes) {
        Authentication auth = SecurityContextHolder.getContext().getAuthentication();
        String email = auth.getName(); // Obtém o email do usuário autenticado

        Usuario usuario = usuarioService.findUsuarioByEmail(email);
        String nomeUsuario = usuario.getNome(); // Obtém o nome do usuário

        redirectAttributes.addAttribute("nomeUsuario", nomeUsuario);
        return "redirect:/pagina_inicial/" + nomeUsuario;
    }

    @GetMapping("/pagina_inicial/{nomeUsuario}")
    public String paginaInicial(@PathVariable String nomeUsuario, Model model) {
        model.addAttribute("nomeUsuario", nomeUsuario);
        return "pagina_inicial";
    }
}
