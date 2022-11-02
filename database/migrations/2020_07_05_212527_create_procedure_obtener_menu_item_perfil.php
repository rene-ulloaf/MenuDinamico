<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcedureObtenerMenuItemPerfil extends Migration {
    public function up() {
        DB::unprepared('
                DROP PROCEDURE IF EXISTS pa_obtener_menu_item_perfil;
                CREATE PROCEDURE pa_obtener_menu_item_perfil (IN i_padre INT, IN i_idPerfil INT) BEGIN
                        DECLARE v_idMenu_Item INT;
                        DECLARE v_idPerfil INT;
                        DECLARE v_menu VARCHAR(45);
                        DECLARE v_mi VARCHAR(45);
                        DECLARE v_descripcion VARCHAR(450);
                        DECLARE v_desplegable INT;
                        DECLARE v_lectura INT;
                        DECLARE v_escritura INT;
                        DECLARE v_modifica INT;
                        DECLARE v_elimina INT;

                        DECLARE fin INTEGER DEFAULT 0;
                        DECLARE menu_item_perfil_cursor CURSOR FOR
                                Select mi.idMenu_Item, m.glosa as menu, mi.glosa as mi, mi.descripcion, mi.desplegable
                                From Menu_Item mi
                                Join Menu m On m.idMenu = mi.idMenu
                                Where mi.padre = i_padre and mi.vigente = 1 and m.vigente = 1
                                Order By m.glosa, mi.padre, mi.orden
                        ;
                        DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = 1;

                        SET max_sp_recursion_depth=255;
                        CREATE TEMPORARY TABLE IF NOT EXISTS tempMenuItemPerfil(idMenu_Item INT, idPerfil INT, menu VARCHAR(45), mi VARCHAR(45), descripcion VARCHAR(450), desplegable INT, lectura INT, escritura INT, modifica INT, elimina INT);

                        OPEN menu_item_perfil_cursor;
                        get_menu_item_perfil: LOOP
                                FETCH menu_item_perfil_cursor INTO v_idMenu_Item, v_menu, v_mi, v_descripcion, v_desplegable;

                                IF fin = 1 THEN
                                        LEAVE get_menu_item_perfil;
                                END IF;

                                Set @v_idPerfil := (Select idPerfil From Perfil_Menu_Item Where idPerfil = i_idPerfil And idMenu_Item = v_idMenu_Item Limit 1);
                                Set @v_lectura := (Select lectura From Perfil_Menu_Item Where idPerfil = i_idPerfil And idMenu_Item = v_idMenu_Item Limit 1);
                                Set @v_escritura := (Select escritura From Perfil_Menu_Item Where idPerfil = i_idPerfil And idMenu_Item = v_idMenu_Item Limit 1);
                                Set @v_modifica := (Select modifica From Perfil_Menu_Item Where idPerfil = i_idPerfil And idMenu_Item = v_idMenu_Item Limit 1);
                                Set @v_elimina := (Select elimina From Perfil_Menu_Item Where idPerfil = i_idPerfil And idMenu_Item = v_idMenu_Item Limit 1);

                                INSERT INTO tempMenuItemPerfil (idMenu_Item, idPerfil, menu, mi, descripcion, desplegable, lectura, escritura, modifica, elimina)
                                Values(v_idMenu_Item, @v_idPerfil, v_menu, v_mi, v_descripcion, v_desplegable, @v_lectura, @v_escritura, @v_modifica, @v_elimina);

                                CALL pa_obtener_menu_item_perfil(v_idMenu_Item, i_idPerfil); 
                        END LOOP get_menu_item_perfil;
                        CLOSE menu_item_perfil_cursor;
                END;
        ');
    }

    public function down() {
        //
    }
}