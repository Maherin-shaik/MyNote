<?php
$insert = false;
$update=false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "MyNotes";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn)
  die("Sorry we failed to connect: " . mysqli_connect_error());
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           
          if(isset($_POST['editsno'])){
                  $title = $_POST["edittitle"];
                  $description = $_POST["editdescription"];
                  $sno=$_POST["editsno"];
                  $sql = "UPDATE `notes` SET `title` ='$title' , `description` = '$description' WHERE `notes`.`sno` = '$sno'";
                  $result = mysqli_query($conn, $sql);
                  if ($result)
                    $update = true;
                  
            }
          else{
              $title = $_POST["title"];
              $description = $_POST["description"];
              $sql = "INSERT INTO `notes` (`title`,`description`) VALUES('$title','$description')";
              $result = mysqli_query($conn, $sql);
              if ($result)
                $insert = true;
              }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyNOTES</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
</head>

<body>
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="mynote.php" method="post">
            <h2>Edit a note</h2>
            <input type="hidden" name="editsno" id="editsno">
            <div class="mb-3">
              <label for="exampleInputtext" class="form-label">Title</label>
              <input type="text" class="form-control" id="edittitle" name="edittitle">
            </div>
            <div class="mb-3">
              <label for="exampleInputtext" class="form-label">Description</label>
              <textarea class="form-control" placeholder="discription" name="editdescription" id="editdescription" style="height: 100px"></textarea>
            </div>
            <button type="update" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MyNOTES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact us</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
  if ($insert) {
    echo   '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your notes was added successfully!.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  elseif($update){
    echo   '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your notes was updated successfully!.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  ?>
  <div class="container">
    <form action="mynote.php" method="post">
      <h2>ADD a note</h2>
      <div class="mb-3">
        <label for="exampleInputtext" class="form-label">Title</label>
        <input type="text" class="form-control" id="exampleInputtext" name="title">
      </div>
      <div class="mb-3">
        <label for="exampleInputtext" class="form-label">Description</label>
        <textarea class="form-control" placeholder="discription" name="description" id="floatingTextarea2" style="height: 100px"></textarea>
      </div>
      <button type="submit " class="btn btn-primary">ADD note</button>
    </form>
  </div>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno++;
          echo  "<tr>
                    <th scope='row'>" . $sno . "</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td><button class='edit btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' id=".$row['sno'].">Edit</button>
                    <button class='delete btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editModal'>Delete</button>
                    </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
    <hr>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
  <script>
    let table = new DataTable('#myTable');
  </script>
  <script>
    edit = document.getElementsByClassName('edit');
    Array.from(edit).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log("edit")
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName('td')[0].innerText;
        description = tr.getElementsByTagName('td')[1].innerText;
        console.log(title);
        console.log(description);
        edittitle.value = title;
        editdescription.value = description;
        editsno.value=e.target.id;
        console.log(editsno);
      })
    })
  </script>
</body>

</html>