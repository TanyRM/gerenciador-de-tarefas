package com.taniele.java_desktop.controller;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.stage.Stage;
import javafx.scene.Scene;
import javafx.fxml.FXMLLoader;
import java.io.IOException;

public class Index {

    @FXML
    private Button entrarButton;

    @FXML
    private Button cadastrarButton;

    @FXML
    private void entrarButtonAction(ActionEvent event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/taniele/java_desktop/view/login.fxml"));
            Stage stage = new Stage();
            stage.setScene(new Scene(loader.load()));
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void cadastrarButtonAction(ActionEvent event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/taniele/java_desktop/view/cadastro.fxml"));
            Stage stage = new Stage();
            stage.setScene(new Scene(loader.load()));
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
