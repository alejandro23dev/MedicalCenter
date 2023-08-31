<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">

<div class="container">
  <div class="row">
    <?php echo view('global/btnsTopAdminSections') ?>
  </div>

  <!--DATATABLE PRODUCTS-->
  <div class="table-primary mt-5">
    <table id="dtProduct" class="display">
      <thead>
        <h2 class="text-center"> Lista De Productos</h2>
        <div class="col-12 col-md-12 mt-5 text-center">
          <button id="btn-newProduct" class="btn btn-primary">Nuevo Producto</button>
        </div>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Descripción</th>
          <th class="text-center"></th>
          <th class="text-center"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $product) : ?>
          <tr>
            <td><img src="data:image/png;base64, <?php echo base64_encode($product->image); ?>" alt="Imagen del producto" class="w-25"></td>
            <td><?php echo $product->name ?></td>
            <td><?php
                $categoryId = $product->fkcategory;
                foreach ($categories as $category) {
                  if ($category->id == $categoryId) {
                    echo $category->name;
                    break;
                  }
                }
                ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $product->quantity ?></td>
            <td><?php echo $product->info ?></td>
            <td><button class="btn btn-warning" id="btn-editProduct" data-id="<?= $product->id; ?>"><i class="mdi mdi-pencil"></i></button></td>
            <td><button class="btn btn-danger" id="btn-deleteProduct" data-id="<?= $product->id; ?>"><i class="mdi mdi-delete"></i></button></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!--DATATABLE CATEGORY-->

  <div class="table-primary">
    <table id="dtCategory" class="display">
      <thead>
        <h1 class="text-center"> Lista De Categorías</h1>
        <div class="col-12 col-md-12 mt-5 text-center">
          <button id="btn-newCat" class="btn btn-success">Nueva Categoría</button>
        </div>
        <tr>
          <th>Nombre</th>
          <th class="text-center"></th>
          <th class="text-center"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category) : ?>
          <tr>
            <td><?php echo $category->name ?></td>
            <td><button class="btn btn-warning" id="btn-editCategory" data-id="<?php echo $category->id; ?>"><i class="mdi mdi-pencil"></i></button></td>
            <td><button class="btn btn-danger" id="btn-deleteCategory" data-id="<?php echo $category->id; ?>"><i class="mdi mdi-delete"></i></button></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/dataTables.bootstrap5.min.js'); ?>"></script>

<script>
  $(document).ready(function() {

    let dtProduct = $('#dtProduct').DataTable({ // DATA TABLE PRODUCT
      destroy: true,
      processing: false,
      serverSide: false,
      responsive: true,
      bAutoWidth: true,
      pageLength: 5,
      lengthMenu: [
        [5, 10, 25, 50],
        [5, 10, 25, 50]
      ],
      language: {
        url: '<?php echo base_url('assets/libs/dataTable/es.json'); ?>'
      },

      order: [
        [1, 'asc']
      ],
      columnDefs: [{
          orderable: false,
          targets: [6,7]
        },

      ],

    });

    // CREATE Product
    $('#btn-newProduct').on('click', function() {

      $.ajax({

        type: "post",
        url: "<?php echo base_url('AdminActions/showModalProduct') ?>",
        data: {
          action: 'create'
        },
        dataType: "html",
        success: function(htmlResponse) {
          $('#main-modal').html(htmlResponse);
        },
        error: function(error) {
          showToast('error', 'Ha ocurrido un error');
        }
      });
    });

    // EDIT PRODUCT
    dtProduct.on('click', '#btn-editProduct', function() { // EDIT PRODUCT

      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/showModalProduct'); ?>",
        data: {
          action: 'update',
          productID: $(this).attr('data-id')
        },
        dataType: "html",
        success: function(htmlResponse) {
          $('#main-modal').html(htmlResponse);
        },
        error: function(error) {
          showToast('error', 'Ha ocurrido un error');
        },
      });

    });

    // DELETE PRODUCT
    dtProduct.on('click', '#btn-deleteProduct', function() { // EDIT PRODUCT

      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/deleteProduct'); ?>",
        data: {
          productID: $(this).attr('data-id'),
        },
        dataType: "html",
        success: function(htmlResponse) {
          $('#main-modal').html(htmlResponse);
          window.location.reload();
        },
        error: function(error) {
          showToast('error', 'Ha ocurrido un error');
        }
      });

    });


    /************************************************************************/

    let dtCategory = $('#dtCategory').DataTable({ // DATA TABLE Category
      destroy: true,
      processing: false,
      serverSide: false,
      responsive: true,
      bAutoWidth: true,
      pageLength: 5,
      lengthMenu: [
        [5, 10, 25, 50],
        [5, 10, 25, 50]
      ],
      language: {
        url: '<?php echo base_url('assets/libs/dataTable/es.json'); ?>'
      },

      order: [
        [0, 'asc']
      ],
      columnDefs: [{
        orderable: false,
        targets: [1,2]
      }, ],

    });

    // CREATE CATEGORY
    $('#btn-newCat').on('click', function() {

      $.ajax({

        type: "post",
        url: "<?php echo base_url('AdminActions/showModalCat') ?>",
        data: {
          action: 'create'
        },
        dataType: "html",
        success: function(htmlResponse) {
          $('#main-modal').html(htmlResponse);
        },
        error: function(error) {
          showToast('error', 'Ha ocurrido un error');
        }
      });
    });

    // EDIT Category
    dtCategory.on('click', '#btn-editCategory', function() { // EDIT PRODUCT

      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/showModalCat'); ?>",
        data: {
          action: 'update',
          categoryID: $(this).attr('data-id')
        },
        dataType: "html",
        success: function(htmlResponse) {
          $('#main-modal').html(htmlResponse);
        },
        error: function(error) {
          showToast('error', 'Ha ocurrido un error');
        },
      });
    });

    // DELETE CATEGORY
    dtCategory.on('click', '#btn-deleteCategory', function() { // EDIT PRODUCT

      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/deleteCat'); ?>",
        data: {
          categoryID: $(this).attr('data-id'),
        },
        dataType: "json",
        success: function(jsonResponse) {
          window.location.reload();
        },
        error: function(error) {
          showToast('error', 'Ha ocurrido un error');
        }
      });

    });
  });
</script>