package com.taniele.java_spring.services;

import com.taniele.java_spring.entity.Usuario;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Controller;
import org.springframework.stereotype.Service;

@Service
public class GerenciadorService {

    private final UsuarioService usuarioService;
    private final PasswordEncoder passwordEncoder;

    public GerenciadorService(UsuarioService usuarioService, PasswordEncoder passwordEncoder) {
        this.usuarioService = usuarioService;
        this.passwordEncoder = passwordEncoder;
    }

    public void salvarNovoUsuario(String nome, String email, String senha) {
        Usuario usuario = new Usuario(nome, email, senha);
        // Criptografar a senha antes de salvar o usuário
        usuario.setSenha(passwordEncoder.encode(usuario.getSenha()));
        usuarioService.salvarUsuario(usuario);
    }
}
