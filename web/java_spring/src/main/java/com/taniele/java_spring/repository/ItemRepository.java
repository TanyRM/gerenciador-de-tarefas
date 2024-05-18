package com.taniele.java_spring.repository;

import com.taniele.java_spring.entity.Item;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ItemRepository extends JpaRepository<Item, Long> {
}
