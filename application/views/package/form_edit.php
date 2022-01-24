<?php
foreach ($package as $rows) :
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <small>Edit Paket</small></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="form_edit" method="POST" action="<?php echo base_url('Package/saveUpdateDataPackage') ?>">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label>Nama Paket</label>
                                <input class="form-control" id="namePackage" name="namePackage" type="text" placeholder="Nama Paket" value="<?php echo $rows['name_package'];?>">
                            </div>

                            <div class="form-group">
                                <label>Keterangan Paket</label>
                                <input class="form-control" id="descriptionPackage" name="descriptionPackage" type="text" placeholder="Keterngan Paket" value="<?php echo $rows['description'];?>">
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input class="form-control" id="abonemen" name="abonemen" type="text" placeholder="Harga Paket" value="<?php echo $rows['abonemen'];?>">
                            </div>
                           
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="idPackage" value="<?php echo $rows['id_package'];?>" />
                            <button type="submit" class="btn btn-primary btnsave">UPDATE</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </section>
    </div>
<?php
endforeach;
?>
<script>
    $(document).ready(function() {

        $('').change(function() {
            var idTower = $(this).val();
            $.ajax({
                url: "<?= base_url(''); ?>",
                method: "POST",
                data: {
                    idTower: idTower
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option>' + data[i].lantai + '</option>';
                    }
                    $('#nmUnit').html(html);

                }
            });
        });
        $('.btnsave').click(function() {
            var nmStatus = $('#nmStatus').val();
            if(nmStatus == '') {
                
            }
        });

    });
</script>