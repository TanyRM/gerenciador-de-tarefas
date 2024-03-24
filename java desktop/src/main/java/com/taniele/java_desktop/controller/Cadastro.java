package com.taniele.java_desktop.controller;

import com.taniele.java_desktop.model.Gerenciador;
import com.taniele.java_desktop.model.Usuario;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

import java.io.IOException;

public class Cadastro {

    private Gerenciador gerenciador;

    public Cadastro() {
        // Inicializa o gerenciador se não estiver presente na sessão
        if (gerenciador == null) {
            gerenciador = new Gerenciador();
        }
    }

    @FXML
    private TextField emailField;

    @FXML
    private TextField nomeField;

    @FXML
    private PasswordField senhaField;

    @FXML
    private Button cadastrarButton;

    @FXML
    private void cadastrarButtonAction() throws IOException {
        // Obtém os valores dos campos de entrada
        String email = emailField.getText();
        String nome = nomeField.getText();
        String senha = senhaField.getText();

        // Cria um novo usuário com os valores inseridos
        Usuario usuario = new Usuario(email, nome, senha);

        // Adiciona o usuário ao gerenciador
        gerenciador.adicionarUsuario(usuario);

        // Fecha a cena atual
        Stage stage = (Stage) cadastrarButton.getScene().getWindow();
        stage.close();

        // Carrega a cena de login
        FXMLLoader loader = new FXMLLoader(getClass().getResource("login.fxml"));
        Parent root = loader.load();

        // Cria uma nova cena com a raiz carregada
        Scene scene = new Scene(root);

        // Obtém o controlador da cena de login
        Login login = loader.getController();

        // Exibe a nova cena
        Stage loginStage = new Stage();
        loginStage.setScene(scene);
        loginStage.setTitle("Login");
        loginStage.show();
    }

    @FXML
    private void loginLinkAction() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/taniele/java_desktop/view/login.fxml"));
            Stage stage = new Stage();
            stage.setScene(new Scene(loader.load()));
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

}
