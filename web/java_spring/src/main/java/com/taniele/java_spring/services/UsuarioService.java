package com.taniele.java_spring.services;

import com.taniele.java_spring.entity.Usuario;
import com.taniele.java_spring.repository.UsuarioRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.ArrayList;

@Service
public class UsuarioService implements UserDetailsService {

    private final UsuarioRepository usuarioRepository;
    private final Logger logger = LoggerFactory.getLogger(UsuarioService.class);

    public UsuarioService(UsuarioRepository usuarioRepository) {
        this.usuarioRepository = usuarioRepository;
    }

    @Override
    public UserDetails loadUserByUsername(String nome) throws UsernameNotFoundException {
        Usuario usuario = usuarioRepository.findByNome(nome);
        if (usuario == null) {
            throw new UsernameNotFoundException("Usuário não encontrado");
        }
        return new org.springframework.security.core.userdetails.User(usuario.getNome(), usuario.getSenha(), new ArrayList<>());
    }

    @Transactional
    public void salvarUsuario(Usuario usuario) {
        usuarioRepository.save(usuario);
        logger.info("Usuário {} adicionado ao banco de dados", usuario.getNome());
    }

    public Usuario findByNome(String nome) {
        return usuarioRepository.findByNome(nome);
    }
}