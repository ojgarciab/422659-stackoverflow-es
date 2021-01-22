<?php

class Mys {
    function connect(){
        return new PDO('mysql:localhost/binplaza_colas', 'root', '');
    }

    function FAC0014($a, $b){
        // echo $a; echo $b;
        $conexion = $this->connect();
        $query = $conexion->prepare('
            SELECT Id_user, Id_state
            FROM binplaza_colas.quotes
            WHERE Time_registry BETWEEN :in AND :to
        '); 
        /* Si la preparación no es emulada, comprobamos si fue bien */
        if ($query === false) {
            /* En caso de ir mal mostramos el mensaje de error */
            die(
                htmlspecialchars(
                    implode(", ", $conexion->errorInfo())
                )
            );
        }
        $resultado = $query->execute([
            ':in' => $a,
            ':to' => $b,
        ]);
        /* Comprobamos si la consulta SQL fue bien */
        if ($resultado === false) {
            /* En caso de ir mal mostramos el mensaje de error */
            die(
                htmlspecialchars(
                    implode(", ", $query->errorInfo())
                )
            );
        }
        return $query;
    }
}

function FAF0011($a) {
    $mys = new Mys();
//  error_log(print_r($a.'<br>'.$b,true)); //depurrador php
    $a = date ('Y-m-d 06:00:00' , strtotime($a));
    $b = date ('Y-m-d H:i:s' , strtotime('+24 hour', strtotime($a)));
    $res = $mys->FAC0014($a, $b);
    if ($res->rowCount() >= 1) {
        $row = $res->fetch();
        $items = array(
            'a_a'       => $row['Id_user'],
            'a_b'       => $row['Id_state']
        );
        var_export($items);
    } else {
        /* En caso de ir mal mostramos el mensaje de error */
        die(
            htmlspecialchars(
                implode(", ", $res->errorInfo())
            )
        );
    }
    //$this->FAF0002($items,1);
}

FAF0011("2021-01-21");
