<!DOCTYPE html>
<html>
<head>
  <title>My Page</title>
  <!-- Add the Bootstrap CSS file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <!-- Add the Bootstrap JavaScript file -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <!-- Add the Select JS file -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

  <script>
     $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
        });
    });
  </script>
<style>
tbody {
    display: block;
    max-height: 200px;
    overflow: auto;
}
thead, tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}
</style>

</head>
  <body style="background-color:#D3D3D3;">
  <header>
          <?php include "nav.php"; ?>
  </header>
  <main>
  <div class="container">
      <div class="row">
        <div class="col-12">
        <h3>Current Instructor</h3>
        <table class="table table-bordered table-striped">
          <thead class="position-sticky top-0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Row 1, Column 1</td>
                <td class="col-2">Row 1, Column 2</td>
              </tr>
              <tr>
                <td>Row 2, Column 1</td>
                <td class="col-2">Row 2, Column 2</td>
              </tr>
            </tbody>
          </table>
        </div>
        <hr>
        <h3>Available Instructors</h3>
        <div class="col-12" >
        <table class="table table-bordered table-striped">
          <thead class="position-sticky top-0">
            <tr>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead class="tbodyMod">
          <tbody>
          <tr>
                <td>Row 1, Column 1</td>
                <td class="col-2">Row 1, Column 2</td>
              </tr>
              <tr>
                <td>Row 2, Column 1</td>
                <td class="col-2">Row 2, Column 2</td>
              </tr><tr>
                <td>Row 1, Column 1</td>
                <td class="col-2">Row 1, Column 2</td>
              </tr>
              <tr>
                <td>Row 2, Column 1</td>
                <td class="col-2">Row 2, Column 2</td>
              </tr><tr>
                <td>Row 1, Column 1</td>
                <td class="col-2">Row 1, Column 2</td>
              </tr>
              <tr>
                <td>Row 2, Column 1</td>
                <td class="col-2">Row 2, Column 2</td>
              </tr><tr>
                <td>Row 1, Column 1</td>
                <td class="col-2">Row 1, Column 2</td>
              </tr>
              <tr>
                <td>Row 2, Column 1</td>
                <td class="col-2">Row 2, Column 2</td>
              </tr>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </main>
</body>
</html>