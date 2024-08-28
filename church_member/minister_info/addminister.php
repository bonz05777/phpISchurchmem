<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Add New Minister</title>
</head>

<body>
  <h2>Add New Minister</h2>
  <form action="ministeradd.php" method="POST">
    <div>
      <label for="ministerID">Minister ID:</label>
      <input type="text" id="ministerID" name="ministerID" placeholder="Enter Minister ID" required>
    </div>
    <div>
      <label for="ministerfname">First Name:</label>
      <input type="text" id="ministerfname" name="ministerfname" placeholder="Enter First Name" required>
    </div>
    <div>
      <label for="ministermname">Middle Name:</label>
      <input type="text" id="ministermname" name="ministermname" placeholder="Enter Middle Name">
    </div>
    <div>
      <label for="ministerlname">Last Name:</label>
      <input type="text" id="ministerlname" name="ministerlname" placeholder="Enter Last Name" required>
    </div>
    <div>
      <button type="submit" name="save">Save</button>
      <button onclick="window.close()">Cancel</button>
    </div>
  </form>
</body>

</html>