<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcedureObtenerMenuItem extends Migration {
    public function up() {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS pa_obtener_menu_item;
            CREATE PROCEDURE pa_obtener_menu_item (IN idMenu INT, IN padre INT) BEGIN
                DECLARE v_idMenu_Item int;
                DECLARE v_menu_padre VARCHAR(45);
                DECLARE v_padre INT;
                DECLARE v_glosa VARCHAR(45);
                DECLARE v_link VARCHAR(150);
                DECLARE v_imagen VARCHAR(500);
                DECLARE v_target VARCHAR(45);
                DECLARE v_desplegable TINYINT;
                DECLARE v_habilitado TINYINT;
                DECLARE v_descripcion VARCHAR(500);
                DECLARE v_orden TINYINT;
                DECLARE v_vigente TINYINT;
                DECLARE v_idMenu INT;
                DECLARE v_idUsuario INT;
                DECLARE v_idPerfil INT;
                DECLARE fin INTEGER DEFAULT 0;
                DECLARE menu_item_cursor CURSOR FOR
                    Select mi.idMenu_Item, mi2.glosa as menu_padre, mi.padre, mi.glosa, mi.link, mi.imagen, mi.target, mi.desplegable, mi.habilitado, mi.descripcion, mi.orden, mi.vigente, mi.idMenu/*, pu.idUsuario, p.idPerfil*/
                    From Menu_Item mi
                    Left Join Menu_Item mi2 On mi.padre = mi2.idMenu_Item
                    /*join Perfil_Menu_Item pmi on pmi.idMenu_Item = mi.idMenu_Item
                    join Perfil p on p.idPerfil = pmi.idPerfil
                    join Perfil_Usuario pu on pu.idPerfil = p.idPerfil*/
                    Where mi.idMenu = idMenu And mi.padre = padre
                    Order By mi.padre, mi.orden
                ;
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = 1;

                SET max_sp_recursion_depth=255;
                CREATE TEMPORARY TABLE IF NOT EXISTS tempMenuITem(
                idMenu_Item INT,
                menu_padre VARCHAR(45),
                padre INT,
                glosa VARCHAR(45),
                link VARCHAR(150),
                imagen VARCHAR(500),
                target VARCHAR(45),
                desplegable TINYINT,
                habilitado TINYINT,
                descripcion VARCHAR(500),
                orden TINYINT,
                vigente TINYINT,
                idMenu INT/*,
                idUsuario INT,
                idPerfil INT*/
                );

                OPEN menu_item_cursor;
                get_menu_item: LOOP
                        FETCH menu_item_cursor INTO v_idMenu_Item, v_menu_padre, v_padre, v_glosa, v_link, v_imagen, v_target, v_desplegable, v_habilitado, v_descripcion, v_orden, v_vigente, v_idMenu/*, v_idUsuario, v_idPerfil*/;

                        IF fin = 1 THEN
                            LEAVE get_menu_item;
                        END IF;

                        INSERT INTO tempMenuITem (idMenu_Item, menu_padre, padre, glosa, link, imagen, target, desplegable, habilitado, descripcion, orden, vigente, idMenu/*, idUsuario, idPerfil*/)
                        Values(v_idMenu_Item, v_menu_padre, v_padre, v_glosa, v_link, v_imagen, v_target, v_desplegable, v_habilitado, v_descripcion, v_orden, v_vigente, v_idMenu/*, v_idUsuario, v_idPerfil*/);

                        CALL pa_obtener_menu_item(idMenu, v_idMenu_Item); 
                END LOOP get_menu_item;
                CLOSE menu_item_cursor;
            END;
        ');
    }

    public function down() {
        //
    }
}