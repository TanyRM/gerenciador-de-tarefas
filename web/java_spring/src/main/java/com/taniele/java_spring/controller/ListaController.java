package com.taniele.java_spring.controller;

import com.taniele.java_spring.repository.ListaRepository;
import com.taniele.java_spring.services.ListaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class ListaController {

    @Autowired
    private ListaService listaService;
    @Autowired
    private ListaRepository listaRepository;
}
