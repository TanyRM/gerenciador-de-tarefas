package com.taniele.java_desktop.controller;

import com.taniele.java_desktop.model.Gerenciador;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

import java.io.IOException;

public class Login {

    @FXML
    private TextField usernameField;

    @FXML
    private PasswordField passwordField;

    @FXML
    private Button loginButton;

    @FXML
    private Label messageLabel;

    private Gerenciador gerenciador;
    @FXML
    private void initialize() {
        // Inicialização do controlador, se necessário
    }

    @FXML
    private void loginButtonAction() {
        String username = usernameField.getText();
        String password = passwordField.getText();

        if (gerenciador.validarDados(username, password)) {
            messageLabel.setText("Login bem-sucedido!");

            try {
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/taniele/java_desktop/view/paginaInicial.fxml"));
                Stage stage = new Stage();
                stage.setScene(new Scene(loader.load()));
                stage.show();
            } catch (IOException e) {
                e.printStackTrace();
            }
        } else {
            messageLabel.setText("Nome de usuário ou senha incorretos.");
        }
    }

    @FXML
    private void cadastroLinkAction() {
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