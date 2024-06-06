package com.taniele.java_spring.controller;

import com.taniele.java_spring.entity.Lista;
import com.taniele.java_spring.entity.Usuario;
import com.taniele.java_spring.repository.UsuarioRepository;
import com.taniele.java_spring.services.ListaService;
import com.taniele.java_spring.services.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.security.core.userdetails.User;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import java.util.List;

@Controller
public class UsuarioController {

    @Autowired
    private UsuarioService usuarioService;
    @Autowired
    private UsuarioRepository usuarioRepository;
    @Autowired
    private ListaService listaService;

    @Controller
    public class SeuControlador {

        @Autowired
        private UsuarioService usuarioService;

        @Autowired
        private ListaService listaService;

        @GetMapping("/pagina_inicial/{nomeUsuario}")
        public String paginaInicial(@PathVariable String nomeUsuario, Model model) {
            Usuario usuario = usuarioService.findByNome(nomeUsuario);
            List<Lista> listas = listaService.findAllByUsuario(usuario);
            model.addAttribute("nomeUsuario", nomeUsuario);
            model.addAttribute("listas", listas);
            return "pagina_inicial";
        }

        @GetMapping("/criar_lista")
        public String criarLista(Model model) {
            model.addAttribute("listaForm", new Lista());
            return "criar_lista";
        }

        @PostMapping("/criar_lista")
        public String salvarLista(@ModelAttribute Lista lista, @AuthenticationPrincipal User user) {
            Usuario usuario = usuarioService.findUsuarioByEmail(user.getUsername());
            lista.setUsuario(usuario);
            listaService.salvarNovaLista(lista);
            System.out.println("Lista salva com sucesso");

            return "redirect:/pagina_inicial/" + usuario.getNome();
        }

        @GetMapping("/login-success")
        public String loginSuccess(RedirectAttributes redirectAttributes, Authentication authentication) {
            UserDetails userDetails = (UserDetails) authentication.getPrincipal();
            String email = userDetails.getUsername(); // Obtém o email do usuário autenticado
            Usuario usuario = usuarioService.findUsuarioByEmail(email);
            String nomeUsuario = usuario.getNome(); // Obtém o nome do usuário

            redirectAttributes.addFlashAttribute("nomeUsuario", nomeUsuario);
            return "redirect:/pagina_inicial/" + nomeUsuario;
        }
    }
}