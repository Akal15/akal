<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<style>
.error {
  color: red;
}
</style>
</head>
<body>

<h2>Registration Form</h2>

<form action="#" onsubmit="return validateForm()">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" required pattern="[A-Za-z ]+" title="Name should contain only letters"><br>

  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" required><br>

  <label for="phone">Phone number:</label><br>
  <input type="text" id="phone" name="phone" required pattern="[0-9]{10}" title="Phone number should be 10 digits"><br>

  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" required minlength="6"><br>

  <label for="confirm_password">Confirm Password:</label><br>
  <input type="password" id="confirm_password" name="confirm_password" required minlength="6"><br>

  <input type="submit" value="Register">
</form>

<script>
function validateForm() {
  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;

  if (password !== confirm_password) {
    alert("Passwords do not match");
    return false;
  }
  alert("Registered successfully!");
  return true;
}
</script>

</body>
</html>

