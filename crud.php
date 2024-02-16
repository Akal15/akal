<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        form {
            max-width: 300px;
        }

        input, select, button {
            margin: 5px 0;
            padding: 8px;
            display: block;
            width: 100%;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Employee Management</h2>

    <div class="container">
        <form action="" method="POST">
            <input type="hidden" name="action" value="create">
            <input type="text" name="emp_name" placeholder="Employee Name" required>
            <select name="emp_department" required>
                <option value="" disabled selected>Select Department</option>
                <option value="IT">IT</option>
                <option value="HR">HR</option>
                <option value="Finance">Finance</option>
            </select>
            <input type="text" name="emp_designation" placeholder="Employee Designation" required>
            <input type="email" name="emp_mail" placeholder="Employee Email" required>
            <input type="tel" name="emp_phone" placeholder="Employee Phone" required>
            <button type="submit">Add Employee</button>
        </form>
    </div>

    <div class="container">
        <h3>Employee List</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php
            $employees = [];
            function createEmployee($data) {
                global $employees;
                $employees[] = $data;
            }

            function deleteEmployee($index) {
                global $employees;
                unset($employees[$index]);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST['action'] == 'create') {
                    $emp_data = array(
                        'name' => $_POST['emp_name'],
                        'department' => $_POST['emp_department'],
                        'designation' => $_POST['emp_designation'],
                        'mail' => $_POST['emp_mail'],
                        'phone' => $_POST['emp_phone']
                    );

                    createEmployee($emp_data);
                }
            }
            foreach ($employees as $index => $employee) {
                echo "<tr>";
                echo "<td>" . $employee['name'] . "</td>";
                echo "<td>" . $employee['department'] . "</td>";
                echo "<td>" . $employee['designation'] . "</td>";
                echo "<td>" . $employee['mail'] . "</td>";
                echo "<td>" . $employee['phone'] . "</td>";
                echo "<td><button onclick='confirmDelete($index)'>Delete</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <script>
        function confirmDelete(index) {
            if (confirm("Are you sure you want to delete this employee?")) {
                window.location.href = "?action=delete&index=" + index;
            }
        }
    </script>
</body>
</html>

