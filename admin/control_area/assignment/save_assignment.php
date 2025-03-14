<?php
include_once "../../../conf/configuracion.php";

try {
    // 1️⃣ OBTENER EL MÁXIMO id_real_assig Y SUMARLE 1
    $queryMaxRealAssig = $base_de_datos->query("SELECT MAX(id_real_assig) AS max_real_assig FROM facility_assignment");
    $resultMaxRealAssig = $queryMaxRealAssig->fetch(PDO::FETCH_ASSOC);
    $new_real_assig = $resultMaxRealAssig['max_real_assig'] + 1;

    // 2️⃣ RECORRER LOS DATOS DEL FORMULARIO
    foreach ($_POST["id_individuals"] as $index => $id_individual) {
        $new_facility = $_POST["id_facility"][$index];
        $notes = $_POST["notes"][$index] ?? ''; // Notas opcionales

        // Obtener la asignación actual del individuo
        $queryCheck = $base_de_datos->prepare("
            SELECT id_assignment, id_facility_name, finish_date 
            FROM facility_assignment 
            WHERE id_individual_assi = ? AND assignment_date IS NOT NULL 
            ORDER BY assignment_date DESC LIMIT 1
        ");
        $queryCheck->execute([$id_individual]);
        $currentAssignment = $queryCheck->fetch(PDO::FETCH_ASSOC);

        // 3️⃣ COMPROBAR SI LA INSTALACIÓN ES LA MISMA
        if ($currentAssignment && $currentAssignment['id_facility_name'] == $new_facility) {
            // ❌ Si es la misma instalación, NO HACER NADA
            continue;
        } else {
            // 4️⃣ SI ES DIFERENTE, ACTUALIZAR LA ANTIGUA ASIGNACIÓN CON UNA FECHA DE FINALIZACIÓN
            if ($currentAssignment) {
                $queryUpdate = $base_de_datos->prepare("
                    UPDATE facility_assignment 
                    SET finish_date = NOW() 
                    WHERE id_assignment = ?
                ");
                $queryUpdate->execute([$currentAssignment['id_assignment']]);
            }

            // 5️⃣ INSERTAR NUEVA ASIGNACIÓN CON LA NUEVA INSTALACIÓN
            $queryInsert = $base_de_datos->prepare("
                INSERT INTO facility_assignment 
                (id_assignment, id_real_assig, id_individual_assi, id_facility_name, assignment_date, finish_date, notes) 
                VALUES (?, ?, ?, ?, NOW(), NULL, ?)
            ");
            $queryInsert->execute([
                null, // id_assignment (auto increment si es PRIMARY KEY)
                $new_real_assig, 
                $id_individual, 
                $new_facility, 
                $notes
            ]);
        }
    }

    // Redireccionar después de completar la operación
    header("Location: insert_assignment.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
