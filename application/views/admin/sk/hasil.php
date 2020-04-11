<a class="media" href="<?php echo base_url(); ?>upload/sk/<?php echo $file_sk[0]->nama_sk; ?>">Click</a>

<script type="text/javascript">
    $(function () {
        $('.media').media({width: 758});
    });
</script>

<script>
    $(function () {
        e.preventDefault();
        $("#myModal").modal('show');
        $.post("<?php echo base_url(); ?>file/hasil/<?php echo $kat_admin; ?>/<?php echo $kategori; ?>",
          {id: $(this).attr('data-id')},
          function (html) {
            $("#preview_file").html(html).toString();
          }
        );
    });
</script>