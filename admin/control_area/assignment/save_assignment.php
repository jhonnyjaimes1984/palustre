<?php
include_once "../../../conf/configuracion.php";

try {
    $base_de_datos->beginTransaction();

    // Obtener el próximo id_real_assig
    $stmt = $base_de_datos->query("SELECT MAX(id_real_assig) AS max_id FROM facility_assignment");
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $new_id_real_assig = $result->max_id ? $result->max_id + 1 : 1;

    // Obtener instalaciones actuales para todos los individuos en POST
    $ids = $_POST['id_individuals'];
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $base_de_datos->prepare("
        SELECT id_individual_assi, id_facility_name 
        FROM facility_assignment 
        WHERE id_individual_assi IN ($placeholders) 
        AND finish_date IS NULL
    ");
    $stmt->execute($ids);
    $current_assignments = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
    $current_facilities = [];
    foreach ($ids as $id_individual) {
        $current_facilities[$id_individual] = $current_assignments[$id_individual] ?? null;
    }

    $changed_individuals = [];
    $original_facilities = [];

    // Identificar cambios y eliminaciones
    foreach ($_POST['id_individuals'] as $index => $id_individual) {
        $submitted_facility = $_POST['id_facility'][$index];
        $current_facility = $current_facilities[$id_individual];

        if ($submitted_facility != $current_facility) {
            $changed_individuals[] = [
                'id_individual' => $id_individual,
                'current_facility' => $current_facility,
                'new_facility' => $submitted_facility,
                'notes' => $_POST['notes'][$index]
            ];

            if ($current_facility !== null) {
                $original_facilities[$current_facility] = true;
            }
        } elseif (empty($submitted_facility)) {
            // Eliminar asignaciones existentes
            $stmt = $base_de_datos->prepare("DELETE FROM facility_assignment WHERE id_individual_assi = ?");
            $stmt->execute([$id_individual]);
        }
    }

    // Procesar instalaciones originales para individuos no cambiados
    foreach (array_keys($original_facilities) as $facility) {
        foreach ($_POST['id_individuals'] as $index => $id_individual) {
            $submitted_facility = $_POST['id_facility'][$index];
            $current_facility = $current_facilities[$id_individual];

            if ($current_facility == $facility && $submitted_facility == $current_facility) {
                // Cerrar asignación actual
                $stmt = $base_de_datos->prepare("
                    UPDATE facility_assignment 
                    SET finish_date = NOW() 
                    WHERE id_individual_assi = ? 
                    AND finish_date IS NULL
                ");
                $stmt->execute([$id_individual]);

                // Crear nueva asignación
                $stmt = $base_de_datos->prepare("
                    INSERT INTO facility_assignment 
                        (id_real_assig, id_individual_assi, id_facility_name, assignment_date, notes) 
                    VALUES (?, ?, ?, NOW(), ?)
                ");
                $stmt->execute([
                    $new_id_real_assig,
                    $id_individual,
                    $current_facility,
                    $_POST['notes'][$index]
                ]);
            }
        }
    }

    // Procesar individuos cambiados
    foreach ($changed_individuals as $individual) {
        $id_individual = $individual['id_individual'];
        $new_facility = $individual['new_facility'];
        $notes = $individual['notes'];

        // Cerrar asignación actual si existe
        if ($individual['current_facility'] !== null) {
            $stmt = $base_de_datos->prepare("
                UPDATE facility_assignment 
                SET finish_date = NOW() 
                WHERE id_individual_assi = ? 
                AND finish_date IS NULL
            ");
            $stmt->execute([$id_individual]);
        }

        // Insertar nueva asignación si la instalación no está vacía
        if (!empty($new_facility)) {
            $stmt = $base_de_datos->prepare("
                INSERT INTO facility_assignment 
                    (id_real_assig, id_individual_assi, id_facility_name, assignment_date, notes) 
                VALUES (?, ?, ?, NOW(), ?)
            ");
            $stmt->execute([
                $new_id_real_assig,
                $id_individual,
                $new_facility,
                $notes
            ]);
        }
    }

    $base_de_datos->commit();
    header("Location: select_assignment.php");
    exit();
} catch (Exception $e) {
    $base_de_datos->rollBack();
    die("Error: " . $e->getMessage());
}
?>