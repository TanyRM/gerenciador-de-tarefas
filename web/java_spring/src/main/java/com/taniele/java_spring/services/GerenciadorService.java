package com.taniele.java_spring.services;

import com.taniele.java_spring.entity.Usuario;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

@Service
public class GerenciadorService {

    private final UsuarioService usuarioService;
    private final PasswordEncoder passwordEncoder;

    @Autowired
    public GerenciadorService(UsuarioService usuarioService, PasswordEncoder passwordEncoder) {
        this.usuarioService = usuarioService;
        this.passwordEncoder = passwordEncoder;
    }

    public void salvarNovoUsuario(Usuario usuario) {
        System.out.println("Salvando novo usuário: " + usuario.getNome());
        usuario.setSenha(passwordEncoder.encode(usuario.getSenha()));
        usuarioService.salvarUsuario(usuario);
    }
}
