package com.taniele.java_spring.controller;

import com.taniele.java_spring.repository.ItemRepository;
import com.taniele.java_spring.services.ItemService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class ItemController {

    @Autowired
    private ItemService itemService;
    @Autowired
    private ItemRepository itemRepository;
}
