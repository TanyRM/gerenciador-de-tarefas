module com.taniele.java_desktop {
    requires javafx.controls;
    requires javafx.fxml;

    requires org.controlsfx.controls;
    requires net.synedra.validatorfx;
    requires org.kordamp.ikonli.javafx;
    requires org.kordamp.bootstrapfx.core;
    requires org.jetbrains.annotations;

    opens com.taniele.java_desktop to javafx.fxml;
    exports com.taniele.java_desktop;
    exports com.taniele.java_desktop.controller;
    exports com.taniele.java_desktop.model;
    opens com.taniele.java_desktop.view to javafx.fxml;
    opens com.taniele.java_desktop.controller to javafx.fxml;

}