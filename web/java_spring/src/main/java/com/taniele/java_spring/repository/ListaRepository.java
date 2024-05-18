package com.taniele.java_spring.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import com.taniele.java_spring.entity.Lista;

public interface ListaRepository extends JpaRepository<Lista, Long> {
}
