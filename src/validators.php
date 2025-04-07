<?php

function validar_contrasena($contrasena): string|null {
    // Verifica si la contraseña tiene al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número
    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $contrasena)) {
        return null; // La contraseña es válida
    } else {
        return "La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.";
    }
}

?>)