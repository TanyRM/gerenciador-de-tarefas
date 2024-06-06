package com.taniele.java_spring.repository;

import com.taniele.java_spring.entity.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;
import com.taniele.java_spring.entity.Lista;

import java.util.List;

public interface ListaRepository extends JpaRepository<Lista, Long> {
    List<Lista> findAllByUsuario(Usuario usuario);
}
