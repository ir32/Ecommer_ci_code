

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >
  <script src="    https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
  

</head>

<body>
    
<div class="card" style="width: 18rem; position: fixed; top: 0; right: 0;">
  <div class="card-body">
    <?php
    $user_id = $this->session->userdata('user_id');
    $user_email = $this->session->userdata('user_email');
    ?>
    <h5 class="card-title">Id : <?php echo $user_id; ?></h5>
    <p class="card-text">E-Mail: <?php echo $user_email; ?></p>
    <a href="<?php echo base_url('user/user_logout'); ?>" class="btn btn-primary">Logout</a>
  </div>
</div>

  <div class="header">
    <h3>List Data</h3>
  </div>
<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#cartModal">Cart <span id="cartCountDisplay">0</span></button>

<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cart Pop-up Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Table will be dynamically generated here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="content">
    <p><?= $this->session->flashdata('msg') ?></p>
    <?= anchor('Product/add/', 'Create', ['class' => 'btn btn-primary mb-2']) ?>

    <table id="productTable" class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Category</th>
          <th>Multiple Image</th>
          <th>Price</th>
          <th>Discount(%),</th>
          <th>Final price</th>
          <th>Action</th>
        </tr>
      </thead>
      
      <tbody>
        <?php
        $no = 1;
        foreach ($products as $upload) { ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $upload->name ?></td>
            <td><?= $upload->slug ?></td>
            <td><?= $upload->category ?></td>
            <td>
              <img src="<?= base_url() ?>assets/upload/images/<?= $upload->image ?>" width="50px" alt="<?= $upload->image ?>">
            </td>
            <td><?= $upload->price ?></td>
            <td><?= $upload->discount ?> </td>
            <td><?= $upload->final_price ?> </td>
            <td>
                <button ><a href="<?= base_url('Product/edit/'.$upload->id) ?>">Edit</a></button>
                <button class="addToCartBtn btn btn-primary" onclick="add_to_cart('<?= $upload->id ?>')">AddToCart</button>
            </td>


          </tr>
        <?php } ?>
      </tbody>
      <button type="button" onclick="exportPdf()" class="btn btn-primary">Export To PDF</button>
    </table>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#productTable').DataTable({
        "pagingType": "simple_numbers", 
        "lengthMenu": [5, 10, 25, 50], 
        "pageLength": 5, 
        "initComplete": function() {
          this.api().columns().every(function() {
            var column = this;
            $('input', this.footer()).on('keyup change clear', function() {
              if (column.search() !== this.value) {
                column.search(this.value).draw();
              }
            });
          });
        }
      });
    });


function exportPdf() {
  var pdf = new jsPDF();
  pdf.text(20, 20, "Product Details");
  pdf.autoTable({
    html: '#productTable',
    startY: 25,
    theme: 'grid',
    columnStyles: {
      0: { cellWidth: 10 },
      1: { cellWidth: 10 },
      2: { cellWidth: 10 },
      3: { cellWidth: 10 }
    },
    bodyStyles: { lineColor: [1, 1, 1] },
    styles: { minCellHeight: 10 }
  });
  pdf.save("product.pdf");
}

var cartCount = 0;
var cartData = [];
var base_url_data = "<?php echo base_url(); ?>";

function add_to_cart(productId) {
    cartCount++;
    console.log('Product ID:', productId);

    document.getElementById('cartCountDisplay').innerText = cartCount;

    $.ajax({
        type: "POST",
        url: base_url_data + "Product/add_to_cart/" + productId,
        success: function(response) {
            try {
                
                if (Array.isArray(response)) {
                    var isProductAdded = false;

                    cartData.forEach(function(product) {
                        if (product.id === response[0].id) {
                            product.quantity++;
                            product.totalPrice = product.quantity * parseFloat(response[0].price);
                            isProductAdded = true;
                        }
                    });
                    console.log('Response Data:', response);

                    if (!isProductAdded) {
                        cartData.push({
                            id: response[0].id,
                            name: response[0].name,
                            price: parseFloat(response[0].price),
                            quantity: 1,
                            totalPrice: parseFloat(response[0].price)
                        });
                    }
                    updateCartDisplay();
                } else {
                    console.error('Invalid response structure');
                }
            } catch (e) {
                console.error('Error handling response:', e);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
        }
    });
}

function removeProduct(productId) {
    console.log(productId);
    // cartData = cartData.filter(function(product) {
    //     return product.id !== productId;
    // });
    // updateCartDisplay();
}
function updateCartDisplay() {
    var tableHtml = '<table class="table">';
    tableHtml += '<thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Action</th></tr></thead>';
    tableHtml += '<tbody>';

    cartData.forEach(function(product) {
        tableHtml += '<tr>';
        tableHtml += '<td>' + product.id + '</td>';
        tableHtml += '<td>' + product.name + '</td>';
        tableHtml += '<td>' + product.price + '</td>';
        tableHtml += '<td>' + product.quantity + '</td>';
        tableHtml += '<td>' + product.totalPrice.toFixed(2) + '</td>';
        tableHtml += '<td><button onclick="removeProduct(' + product.id + ')">Remove</button></td>';
        tableHtml += '</tr>';
    });

    tableHtml += '</tbody>';
    tableHtml += '</table>';

    $('.modal-body').html(tableHtml);
}

function clearCart() {
    cartData = []; 
    cartCount = 0; 
    updateCartDisplay();
}

var clearCartButtonHtml = '<button type="button" class="btn btn-danger" onclick="clearCart()">Clear Cart</button>';
$('.modal-footer').html(clearCartButtonHtml);

  </script>
</body>

</html>
