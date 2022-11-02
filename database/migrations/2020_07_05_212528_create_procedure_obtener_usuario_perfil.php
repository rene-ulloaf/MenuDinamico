<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcedureObtenerUsuarioPerfil extends Migration {
    public function up() {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS pa_obtener_usuario_perfil;
            CREATE PROCEDURE pa_obtener_usuario_perfil (IN i_idPerfil INT) BEGIN
                DECLARE v_idPerfil INT;
                DECLARE v_idUsuario INT;
                DECLARE v_nombre VARCHAR(45);
                DECLARE v_apellido VARCHAR(45);
                DECLARE v_email VARCHAR(150);

                DECLARE fin INTEGER DEFAULT 0;
                DECLARE usuario_perfil_cursor CURSOR FOR
                    SELECT u.idUsuario, u.nombre, u.apellido, u.email
                    FROM Usuario u
                    Left Join Perfil_Usuario pu on pu.idUsuario = u.idUsuario
                    Where u.vigente = true
                    Group By u.idUsuario Order By u.apellido
                ;
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = 1;

                CREATE TEMPORARY TABLE IF NOT EXISTS tempUsuarioPerfil(
                    idPerfil INT, idUsuario INT, nombre VARCHAR(45), apellido VARCHAR(45), email VARCHAR(150)
                );

                OPEN usuario_perfil_cursor;
                get_usuario_perfil: LOOP
                    FETCH usuario_perfil_cursor INTO v_idUsuario, v_nombre, v_apellido, v_email;

                    IF fin = 1 THEN
                    LEAVE get_usuario_perfil;
                    END IF;

                    Set @v_idPerfil := (Select idPerfil From Perfil_Usuario Where idPerfil = i_idPerfil And idUsuario = v_idUsuario Limit 1);

                    INSERT INTO tempUsuarioPerfil (idPerfil, idUsuario, nombre, apellido, email)
                    Values(@v_idPerfil, v_idUsuario, v_nombre, v_apellido, v_email);

                END LOOP get_usuario_perfil;
                CLOSE usuario_perfil_cursor;
            END;
        ');
    }

    public function down() {
        //
    }
}