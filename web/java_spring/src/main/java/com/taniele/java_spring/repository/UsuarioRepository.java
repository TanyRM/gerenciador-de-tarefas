package com.taniele.java_spring.repository;

import com.taniele.java_spring.entity.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface UsuarioRepository extends JpaRepository<Usuario, Long> {
    Usuario findByNome(String nome);
    Usuario findByEmail(String email);
}
