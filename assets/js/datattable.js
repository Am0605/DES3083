function openaddForm() {
  $("#addProductModal").modal("show");
}
function closeaddForm() {
  $("#addProductModal").modal("hide");
}
function closeeditForm() {
  $("#editproductmodal").modal("hide");
}
function closeeditOrForm() {
  $("#editordermodal").modal("hide");
}

function addProduct() {
  var productname = document.getElementById("productname").value;
  var productdescription = document.getElementById("productdescription").value;
  var price = document.getElementById("price").value;

  if (productname != "" && productdescription != "" && price != "") {
    $.ajax({
      url: "include/add_product.php",
      type: "POST",
      data: $("#addProductForm").serialize(),
      success: function (response) {
        $("#addProductModal").modal("hide");
        $("#product").DataTable().ajax.reload();
        Swal.fire({
          icon: "success",
          title: "SuuuWeetttt",
          text: "New product added successfully.",
        });
      },
    });
  } else {
    Swal.fire({
      title: "bodo ke?",
      text: "fill in the blanks mangkuk !",
      icon: "warning",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Hihi, Okay bang",
    });
  }
  document.getElementById("productname").value = "";
  document.getElementById("productdescription").value = "";
  document.getElementById("price").value = "";
}

function deleteProduct(productid) {
  console.log("deleteProduct dah kene called ", productid);

  $.ajax({
    url: "include/delete_product.php",
    method: "POST",
    data: { productId: productid },
    success: function () {
      Swal.fire("Deleted!", "Your product has been deleted.", "success");
      $("#product").DataTable().ajax.reload();
    },
    error: function (error) {
      console.error("Error deleting product:", error);
    },
  });
}

$(document).on("click", ".delete", function () {
  var productid = $(this).data("productid");

  Swal.fire({
    title: "Serius ah ni?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Check if productId is correct
      console.log(productid);
      deleteProduct(productid);
    }
  });
});

$(document).ready(function () {
  // Event handler for edit button click
  $("#product").on("click", ".edit", function () {
    var productid = $(this).data("productid");
    console.log("Edit button clicked");

    // Fetch the product details for editing (AJAX call required)
    $.ajax({
      url: "include/get_productdetail.php",
      method: "POST",
      data: { productid: productid },
      dataType: "json",
      success: function (response) {
        console.log(response);
        // Populate the form fields with the fetched data
        $("#editproductid").val(response[0].productid);
        $("#editproductname").val(response[0].productname);
        $("#editproductdescription").val(response[0].productdescription);
        $("#editprice").val(response[0].price);

        // Show the edit modal after populating the form fields
        $("#editproductmodal").modal("show");
      },
      error: function (error) {
        console.error(error);
        // Handle error messages if needed
      },
    });
  });
});

function editProduct() {
  $productid = document.getElementById("editproductid").value;
  $productname = document.getElementById("editproductname").value;
  $productdescription = document.getElementById("editproductdescription").value;
  $price = document.getElementById("editprice").value;
  // Make an AJAX request to update the product details
  $.ajax({
    url: "include/update_product.php",
    method: "POST",
    data: {
      productid: $productid,
      productdescription: $productdescription,
      price: $price,
      productname: $productname,
    },
    success: function (response) {
      console.log(response);
      $("#product").DataTable().ajax.reload();
      $("#editproductmodal").modal("hide");
      Swal.fire("Updated!", "Your product has been updated.", "success");
    },
    error: function (error) {
      console.error(error);
      // Handle error messages if needed
    },
  });

  function addOrder() {
        // Retrieve form data
        var formData = $("#addOrderForm").serialize();

        // Make an AJAX request to add the order
        $.ajax({
          url: "include/add_order.php",
          type: "POST",
          data: formData,
          success: function(response) {
              $("#addOrderModal").modal("hide");
              $("#order").DataTable().ajax.reload();
              Swal.fire({
                icon: "success",
                title: "Order Added",
                text: response.message,
              });
            
          },
        });
      }

      function closeorderForm() {
        $('#addOrderModal').modal('hide');
      }
}
