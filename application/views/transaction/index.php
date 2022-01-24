<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo $title; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title; ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Modal Insert-->
  <div class="modal fade" id="addTransaction" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Add Data </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-insert" method="POST" action="<?php echo base_url('Transaction/insertTransaction') ?>">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Number Pelanggan</label>
              <div class="col-sm-10">
                <select id='numberCustomers' name="numberCustomers" class="form-control ">
                  <?php foreach ($customers as $rowscustomer) : ?>
                    <option value="<?php echo $rowscustomer['number_customer']; ?>"><?php echo $rowscustomer['number_customer']; ?> / <?php echo $rowscustomer['name_customer']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="btn-insert">Proses</button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data <?php echo $title; ?></h3><br>
              <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addTransaction">
                Add Transaction <span class="glyphicon glyphicon-plus"></span>
              </button>


              <p> <?php echo $this->session->flashdata('messageupdate'); ?></p>
              <p> <?php echo $this->session->flashdata('message'); ?></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="viewDataTable" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID. Transaksi</th>
                    <th>Tgl. Transaksi</th>
                    <th>tgl. Tagihan</th>
                    <th>Tgl. Jatuh Tempo</th>
                    <th>Nama Pelanggan</th>
                    <th>No. Pelanggan</th>
                    <th>Tot. Tagihan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th colspan="1">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $start = 1;
                  foreach ($transaction as $row) :
                  ?>
                    <tr>
                      <td><?php echo $start++; ?>. </td>
                      <td><?php echo $row['id_transaction']; ?> </td>
                      <td><?php echo $row['date_transaction']; ?> </td>
                      <td><?php echo $row['date_invoice']; ?> </td>
                      <td><?php echo $row['due_date']; ?> </td>
                      <td><?php echo $row['name_customer']; ?> </td>
                      <td><?php echo $row['number_customer']; ?> </td>
                      <td><?php echo number_format($row['abonemen'], 0, ',', '.'); ?></td>
                      <td><?php echo $row['status_transaction']; ?> </td>
                      <td><?php echo $row['description_transaction']; ?> </td>
                      <td><button type="button" rel="tooltip" title="Edit <?php echo $row['id_transaction']; ?>" class="btn btn-info btn-simple btn-xs">
                          <a href="<?php echo base_url('Transaction/editTransaction/' . $row['id_transaction']); ?>"><i class="fa fa-edit"></i></a>
                        </button>
                        <button type="button" rel="tooltip" title="Remove" data-toggle="modal" data-target="#modalDelete<?php echo $row['id_transaction']; ?>" class="btn btn-danger btn-simple btn-xs">
                          <i class="fa fa-times" onClick="return confirmDel();"></i>
                        </button>
                      </td>

                    </tr>

                    <!-- Modal HTML -->
                    <div id="modalDelete<?php echo $row['id_transaction']; ?>" class="modal fade">
                      <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                          <div class="modal-header flex-column">
                            <div class="icon-box">
                              <i class="fa fa-times"></i>
                            </div>
                            <h4 class="modal-title w-100">Are you sure?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Do you really want to delete these records? This process cannot be undone.</p>
                          </div>
                          <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger"><a href="<?php echo base_url('Transaction/deleteTransaction/' . $row['id_transaction']); ?>">Delete</a></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  endforeach;
                  ?>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  $(document).ready(function() {
    $(".spinner-border").show(function() {

      $(this).hide(2000);

    })
    $(".content").hide(function() {

      $(this).show(2000);

    })
    $('.btn-delete').click(function(index) {
      var id = this.id;
      $.ajax({
        url: "<?php echo base_url(); ?>Transaction/deleteItemTransaction",
        type: "POST",
        data: {
          'idTransaction': id
        },
        success: function(data) {
          window.location.reload();
        }
      })

    });


  });
</script>