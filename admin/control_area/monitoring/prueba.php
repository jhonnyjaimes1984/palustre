<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Tables Form - Individuals & Pairs</title>
    <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .table-container {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .remove-btn {
            margin-top: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
</head>
<body>
    <h2>Dynamic Form with Individuals & Pairs Tables</h2>
    <form id="mainForm">
        <button type="button" onclick="addTable('individuals')">Insert - Individuals</button>
        <button type="button" onclick="addTable('pairs')">Insert - Pairs</button>
        <div id="tablesContainer"></div>
        <br>
        <button type="submit">Submit</button>
    </form>

    <script>
        let tableCounter = 0;

        function addTable(type) {
            tableCounter++;
            const container = document.getElementById("tablesContainer");
            const div = document.createElement("div");
            div.className = "table-container";
            div.id = `tableDiv${tableCounter}`;

            let tableHTML = type === 'individuals' ? `
                <h3>Individuals Table (${tableCounter})</h3>
                <table id="example${tableCounter}" class="table table-bordered table-striped table-responsive display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nickname</th>
                            <th>Specie</th>
                            <th>Assignment</th>
                            <th>Sex</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Left Leg</th>
                            <th>Right Leg</th>
                            <th>Insert</th>
                            <th>View</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="id_${tableCounter}" required></td>
                            <td><input type="text" name="nickname_${tableCounter}" required></td>
                            <td><input type="text" name="specie_${tableCounter}" required></td>
                            <td><input type="text" name="assignment_${tableCounter}"></td>
                            <td><input type="text" name="sex_${tableCounter}"></td>
                            <td><input type="number" name="year_${tableCounter}"></td>
                            <td><input type="text" name="status_${tableCounter}"></td>
                            <td><input type="text" name="left_leg_${tableCounter}"></td>
                            <td><input type="text" name="right_leg_${tableCounter}"></td>
                            <td><button type="button">Insert</button></td>
                            <td><button type="button">View</button></td>
                            <td><button type="button">Update</button></td>
                            <td><button type="button">Delete</button></td>
                        </tr>
                    </tbody>
                </table>`
                : `
                <h3>Pairs Table (${tableCounter})</h3>
                <table id="example${tableCounter}" class="table table-bordered table-striped table-responsive display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id Pair</th>
                            <th>Date</th>
                            <th>Pair</th>
                            <th>Facility</th>
                            <th>Notes</th>
                            <th>Insert</th>
                            <th>View</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="pair_id_${tableCounter}" required></td>
                            <td><input type="date" name="date_${tableCounter}" required></td>
                            <td><input type="text" name="pair_${tableCounter}" required></td>
                            <td><input type="text" name="facility_${tableCounter}"></td>
                            <td><input type="text" name="notes_${tableCounter}"></td>
                            <td><button type="button">Insert</button></td>
                            <td><button type="button">View</button></td>
                            <td><button type="button">Update</button></td>
                            <td><button type="button">Delete</button></td>
                        </tr>
                    </tbody>
                </table>`;

            tableHTML += `<button type="button" class="remove-btn" onclick="removeTable('tableDiv${tableCounter}')">Remove Table</button>`;

            div.innerHTML = tableHTML;
            container.appendChild(div);

            // Inicialización de DataTable usando $(document).ready para asegurar su funcionalidad
            $(document).ready(function() {
                $(`#example${tableCounter}`).DataTable({
                    responsive: true,
                    order: [[0, "asc"]],
                    language: {
                        "emptyTable": "No hay datos para mostrar",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "search": "Buscar:",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "lengthMenu": 'Mostrando <select>' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="50">50</option>' +
                            '<option value="100">100</option>' +
                            '<option value="-1">Todos</option>' +
                            '</select> Entradas',
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Next",
                            "previous": "Anterior"
                        }
                    }
                });
            });
        }

        function removeTable(divId) {
            const div = document.getElementById(divId);
            if (div) div.remove();
        }

        $(document).ready(function() {
            $('#mainForm').on('submit', function (event) {
                event.preventDefault();
                alert("Form submitted successfully!");
            });
        });
    </script>
</body>
</html>
