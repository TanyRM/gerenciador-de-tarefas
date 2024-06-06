package com.taniele.java_spring.controller;

import com.taniele.java_spring.entity.Lista;
import com.taniele.java_spring.entity.Usuario;
import com.taniele.java_spring.repository.ListaRepository;
import com.taniele.java_spring.services.ListaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.ResponseStatus;

@Controller
public class ListaController {

    @Autowired
    private ListaService listaService;
    @Autowired
    private ListaRepository listaRepository;


}
