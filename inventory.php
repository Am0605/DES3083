<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <title>Inventory - Sweet Tooth Bakery System</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/data.js"></script>


  <!-- Saja saja JS -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <script src="assets/js/sajasaja.js"></script>
  <script src="assets/js/datattable.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php include("include/dblink.php"); ?>
</head>

<body>
  <?php include("include/header.php"); ?>

  <!-- ======= Tepi ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-heading">Menu</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="inventory.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Inventory</span>
        </a>
      </li><!-- End Inventory Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="order.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Order</span>
        </a>
      </li><!-- End Order Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="supplier.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Supplier</span>
        </a>
      </li><!-- End Supplier Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>  -->
      <!-- End Profile Page Nav  -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li> -->
      <!-- End Register Page Nav  -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li> -->
      <!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Inventory</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Inventory</a></li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section inventory">
      <div class="card w-3 p-3">
        <div align="right">
          <button type="button" name="add" id="addEmployee" class="btn btn-success btn-xs" onclick="openaddForm()">Add Product</button>
        </div>
        <table id="product" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <script>
        $(document).ready(function() {
          $('#product').DataTable({
            "ajax": {
              "url": "include/get_product.php",
              "dataSrc": ""
            },
            "columns": [{
                "data": "productid"
              },
              {
                "data": "productname"
              },
              {
                "data": "productdescription"
              },
              {
                "data": "price"
              },
              {
                "data": null,
                "render": function(data, type, full, meta) {
                  var btnEdit = $('<button/>').addClass('btn btn-info btn-xs edit')
                    .attr('data-productid', data.productid)
                    .attr('data-target', '#editproductmodal')
                    .text('Edit');

                  var btnDelete = $('<button/>').addClass('btn btn-danger btn-xs delete')
                    .attr('data-productid', data.productid)
                    .text('Delete');

                  var btnGroup = $('<div/>').addClass('btn-group')
                    .attr('role', 'group')
                    .append(btnEdit)
                    .append(btnDelete);

                  return $('<div/>').append(btnGroup).html();
                }
              }
            ],
            "searching": false,
          });
        });
      </script>
    </section>
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeaddForm()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="addProductForm" method="post" action="C:\xampp\htdocs\phpscript\sweetsystem\include\add_product.php">
              <div class="form-group">
                <label for="productname">Product Name</label>
                <input type="text" class="form-control" id="productname" name="productname" required>
              </div>
              <div class="form-group">
                <label for="productdescription">Product Description</label>
                <input type="text" class="form-control" id="productdescription" name="productdescription" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeaddForm()">Close</button>
            <button type="submit" class="btn btn-primary" onclick="addProduct()">Add Product</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editproductmodal" tabindex="-1" role="dialog" aria-labelledby="editproductmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editproductmodalLabel">Edit Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeeditForm()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editProductForm" method="post" action="C:\xampp\htdocs\phpscript\sweetsystem\include\update_product.php">
              <!-- Product ID hidden field -->
              <input type="hidden" id="editproductid" name="editproductid">

              <div class="form-group">
                <label for="editproductname">Product Name</label>
                <input type="text" class="form-control" id="editproductname" name="editproductname" required>
              </div>
              <div class="form-group">
                <label for="editproductdescription">Product Description</label>
                <input type="text" class="form-control" id="editproductdescription" name="editproductdescription" required>
              </div>
              <div class="form-group">
                <label for="editprice">Price</label>
                <input type="number" class="form-control" id="editprice" name="editprice" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeeditForm()">Close</button>
            <button type="button" class="btn btn-primary" onclick="editProduct()">Save Changes</button>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
</body>

<?php include("include/footer.php"); ?>

</html>