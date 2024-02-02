<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

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
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

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
  <title>Order - Sweet Tooth Bakery System</title>

  <!-- Sendiri punya -->
  <script src="assets/js/datattable.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/data.js"></script>

  <!-- Saja saja JS -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <?php require 'include/Connection.php'; ?>
</head>

<body>
  <?php require 'require/header.php' ?>

  <?php require 'require/sidebar.php' ?>

  <?php $cart = []; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Inventory</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Inventory</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section order">
      <div class="card w-3 p-3">
        <div align="right">
          <button type="button" name="add" id="addOrder" class="btn btn-success btn-xs" onclick="openaddOrder()">Add Order</button>
        </div>
        <table id="order" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th style="display:none;">product ID</th>
              <th style="display:none;">order ID</th>
              <th>BIL</th>
              <th>Customer</th>
              <th>Address</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Discount (%)</th>
              <th>Total(RM)</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <script>
          $(document).ready(function() {
            $('#order').DataTable({
              "ajax": {
                "url": "include/get_order.php",
                "dataSrc": ""
              },
              "columns": [{
                  "data": "productid",
                  "visible": false
                },
                {
                  "data": "orderid",
                  "visible": false
                },
                {
                  "data": null,
                  "render": function(data, type, full, meta) {
                    return meta.row + 1; // BIL column
                  }
                },
                {
                  "data": "customername"
                },
                {
                  "data": "address"
                },
                {
                  "data": "productname"
                },
                {
                  "data": "quantity"
                },
                {
                  "data": "price"
                },
                {
                  "data": "discount"
                },
                {
                  "data": null,
                  "render": function(data, type, full) {
                    // Calculate Total Price: (Price - Discount) * Quantity
                    var total = (parseFloat(full.price) * parseFloat(full.quantity)) - ((parseFloat(full.price) * parseFloat(full.quantity)) * parseFloat(full.discount) / 100);
                    return total.toFixed(2);
                  }
                },
                {
                  "data": null,
                  "render": function(data, type, full) {
                    var btnEdit = $('<button/>').addClass('btn btn-info btn-xs editorder')
                      .attr('data-orderid', full.orderid)
                      .attr('data-target', '#editordermodal')
                      .text('Edit');

                    var btnDelete = $('<button/>').addClass('btn btn-danger btn-xs deleteorder')
                      .attr('data-orderid', full.orderid)
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

            $('#addOrder').click(function() {
              $('#addOrderModal').modal('show');
            });
          });
        </script>
    </section>
    <!-- modal untuk add order -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="include/add_order.php" method="post" class="php-email-form">
              <div class="mb-3 row">
                <label for="name" class="col-sm-3 col-form-label">Customer Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" class="form-control" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="contactNumber" class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="validationTooltipUsernamePrepend">+60</span>
                    <input type="number" class="form-control" id="validationTooltipUsername" name="contactNumber" aria-describedby="validationTooltipUsernamePrepend" required>
                  </div>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="email" class="col-sm-3 col-form-label">Customer Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="email" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="address" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                  <textarea class="form-control" placeholder="Address" id="address" style="height: 100px;" name="address" required></textarea>
                </div>
              </div>

              <div class="mb-3 row">
                <div class="col-sm-9" style="margin-top: 10px;">
                  <select class="form-select" name="discountType" required>
                    <option selected disabled>Choose discount type</option>
                    <option value="B40">B40 (10%)</option>
                    <option value="M40">M40 (5%)</option>
                  </select>
                </div>
              </div>
              <div class="hehe">
                <div class="mb-3 row product-row">
                  <label for="product" class="col-sm-3 col-form-label">Product Name</label>
                  <div class="col-sm-7">
                    <div class="product-container">
                      <div class="product-row">
                        <select class="form-select" name="order_productid" id="pname" required>
                          <option selected disabled>Choose a product</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                  <div class="col-sm-7">
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                  </div>
                </div>
              </div>
              <!-- <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addProductInput()">Add Product</button> -->

              <!-- <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody id="cartBody"></tbody>
              </table> -->

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeorderForm()">Close</button>
                <button type="submit" class="btn btn-primary" onclick="addOrder()">Submit Order</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editordermodal" tabindex="-1" role="dialog" aria-labelledby="editordermodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editproductmodalLabel">Update Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeeditOrForm()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editOrderForm" method="post" action="include/update_order.php">
              <!-- Order ID hidden field -->
              <input type="hidden" id="editorderid" name="editorderid">

              <div class="mb-3 row">
                <label for="editcustomername" class="col-sm-3 col-form-label">Customer Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editcustomername" name="editcustomername" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="editaddress" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                  <textarea class="form-control" placeholder="Address" id="editaddress" style="height: 100px;" name="editaddress" required></textarea>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="editorder_productid" class="col-sm-3 col-form-label">Product Name</label>
                <div class="col-sm-9">
                  <!-- Assuming you want to keep the existing structure for selecting products -->
                  <div class="product-container">
                    <div class="product-row">
                      <select class="form-select" name="editorder_productid" id="editorder_productid" required>
                        <!-- Options will be dynamically loaded using JavaScript -->
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="editquantity" class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="editquantity" name="editquantity" placeholder="Quantity" required>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-9" style="margin-top: 10px;">
                  <select class="form-select" name="editdiscountType" id="editdiscountType" required>
                    <option selected disabled>Choose discount type</option>
                    <option value="B40">B40 (10%)</option>
                    <option value="M40">M40 (5%)</option>
                  </select>
                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeeditForm()">Close</button>
            <button type="button" class="btn btn-primary" onclick="editOrder()">Save Changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- habis modal -->

    </div>

    <!-- <script>p
      // Example:
      let cart = [];

      // Function to update the table body with the 'cart' data
      function updateCartTable() {
        const tableBody = document.getElementById("cartBody");
        tableBody.innerHTML = ""; // Clear the existing content

        // Loop through the 'cart' array and append rows to the table
        cart.forEach(cartItem => {
          const row = document.createElement("tr");

          const nameCell = document.createElement("td");

          nameCell.textContent = cartItem.name;
          row.appendChild(nameCell);

          const quantityCell = document.createElement("td");
          quantityCell.textContent = cartItem.quantity;
          row.appendChild(quantityCell);

          tableBody.appendChild(row);
        });
      }

      // Call the updateCartTable function to initially populate the table
      updateCartTable();
    </script> -->

    <script>
      // function addProductInput() {
      //   var select = $('select[name="product[]"]');
      //   var quantity = $('input[name="quantity[]"]').val();

      //   if (quantity && quantity > 0) {
      //     var pid = select.val().split('-')[0];
      //     var pname = select.val().split('-')[1];

      //     // Append the selected product and quantity to the table
      //     var row = '<tr><td>' + pname + '</td><td>' + quantity + '</td></tr>';
      //     $('#cartBody').append(row);

      //     // Clear the input fields
      //     select.val('');
      //     $('input[name="quantity[]"]').val('');

      //   } else {
      //     alert('Please enter a valid quantity.');
      //   }
      // }

      $(document).ready(function() {
        // AJAX request to fetch product names
        $.ajax({
          type: 'POST',
          url: 'include/fetch_product.php',
          dataType: 'json',
          success: function(data) {
            var select = $('select[name="order_productid"]');
            select.empty();
            $.each(data, function(index, product) {
              select.append('<option value="' + product.productid + '">' + product.productname + '</option>');
            });
          },
          error: function() {
            console.error('Error fetching product names');
          }
        });
      });
    </script>
  </main><!-- End #main -->
</body>

<?php require 'require/footer.php'; ?>

</html>