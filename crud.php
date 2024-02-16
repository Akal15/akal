<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Management System</title>
<style>
.error {
  color: red;
}
</style>
</head>
<body>

<h2>Employee Details</h2>

<!-- Form for adding/editing employee details -->
<form id="empForm">
  <input type="hidden" id="empId">
  <label for="empName">Employee Name:</label><br>
  <input type="text" id="empName" name="empName" required><br>

  <label for="empDepartment">Employee Department:</label><br>
  <select id="empDepartment" name="empDepartment" required>
    <option value="" disabled selected>Select Department</option>
    <option value="HR">HR</option>
    <option value="Finance">Finance</option>
    <option value="IT">IT</option>
    <option value="Operations">Operations</option>
  </select><br>

  <label for="empDesignation">Employee Designation:</label><br>
  <input type="text" id="empDesignation" name="empDesignation" required><br>

  <label for="empMail">Employee Mail:</label><br>
  <input type="email" id="empMail" name="empMail" required><br>

  <label for="empPhone">Employee Phone Number:</label><br>
  <input type="text" id="empPhone" name="empPhone" required pattern="[0-9]{10}" title="Phone number should be 10 digits"><br>

  <button type="button" onclick="saveEmployee()">Save</button>
</form>

<hr>
<table id="empTable" border="1">
  <thead>
    <tr>
      <th>Employee Name</th>
      <th>Employee Department</th>
      <th>Employee Designation</th>
      <th>Employee Mail</th>
      <th>Employee Phone Number</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<script>
let employees = [];
function saveEmployee() {
  const empId = document.getElementById("empId").value;
  const empName = document.getElementById("empName").value;
  const empDepartment = document.getElementById("empDepartment").value;
  const empDesignation = document.getElementById("empDesignation").value;
  const empMail = document.getElementById("empMail").value;
  const empPhone = document.getElementById("empPhone").value;
  if (!empName || !empDepartment || !empDesignation || !empMail || !empPhone) {
    alert("Please fill out all fields.");
    return;
  }

  const employee = { empId, empName, empDepartment, empDesignation, empMail, empPhone };

  // Check if adding new employee or editing existing one
  if (empId) {
    const index = employees.findIndex(emp => emp.empId == empId);
    employees[index] = employee;
  } else {
    employee.empId = Date.now(); // Generate unique ID
    employees.push(employee);
  }

  // Clear form fields
  document.getElementById("empForm").reset();
  document.getElementById("empId").value = "";

  // Render employee table
  renderEmployees();
}

// Function to delete an employee
function deleteEmployee(empId) {
  employees = employees.filter(emp => emp.empId != empId);
  renderEmployees();
}

// Function to edit an employee
function editEmployee(empId) {
  const employee = employees.find(emp => emp.empId == empId);
  if (employee) {
    document.getElementById("empId").value = employee.empId;
    document.getElementById("empName").value = employee.empName;
    document.getElementById("empDepartment").value = employee.empDepartment;
    document.getElementById("empDesignation").value = employee.empDesignation;
    document.getElementById("empMail").value = employee.empMail;
    document.getElementById("empPhone").value = employee.empPhone;
  }
}

// Function to render employee table
function renderEmployees() {
  const tableBody = document.getElementById("empTable").getElementsByTagName('tbody')[0];
  tableBody.innerHTML = "";

  employees.forEach(employee => {
    const row = tableBody.insertRow();

    const nameCell = row.insertCell(0);
    nameCell.textContent = employee.empName;

    const departmentCell = row.insertCell(1);
    departmentCell.textContent = employee.empDepartment;

    const designationCell = row.insertCell(2);
    designationCell.textContent = employee.empDesignation;

    const mailCell = row.insertCell(3);
    mailCell.textContent = employee.empMail;

    const phoneCell = row.insertCell(4);
    phoneCell.textContent = employee.empPhone;

    const actionCell = row.insertCell(5);
    const editButton = document.createElement("button");
    editButton.textContent = "Edit";
    editButton.onclick = function() {
      editEmployee(employee.empId);
    };
    actionCell.appendChild(editButton);

    const deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.onclick = function() {
      deleteEmployee(employee.empId);
    };
    actionCell.appendChild(deleteButton);
  });
}

</script>

</body>
</html>

