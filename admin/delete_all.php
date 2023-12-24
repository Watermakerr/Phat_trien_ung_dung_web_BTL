<script type="text/javascript">
    $(function(){
        /* Check/bỏ chek hết tất cả các records */
        $(document).on('change','#check_all', function(ev){
            $('.checkitem').prop('checked', this.checked).trigger('change');
        });
        /* Check/bỏ chek từng records */
        $(document).on('change','.checkitem', function(ev){
            var _dem = 0;
            var _checked = 1;
            /* Duyệt tất cả các checkitem */
            $('.checkitem').each(function(){
                if($(this).is(':checked')){
                    _dem ++;
                }else{
                    _checked = 0;
                }
            });
            $('#check_all').prop('checked', _checked);
            if(_dem > 0) {
                // Hiện nút xóa chọn
                $('button[name=submmit]').show();
            }else{
                // Ẩn nút xóa chọn
                $('button[name=submmit]').hide();
            }
        });
    });
</script>


<?php
    require_once('connect.php');
    // Câu lệnh truy vấn
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $totalRecord = mysqli_num_rows($result);
    // Danh sách
    if($totalRecord > 0){ ?>
    <form method="post" action="/demo/php-mysql-delete-multiple/delete.php">
        <table class="tbl-grid" cellpadding="0" cellspacing="0" awidth="100%">
            <thead>
                <th class="gridheader" awidth="5%" style="text-align:center"input id="check_all" type="checkbox"></th>
                <th class="gridheader" awidth="5%" style="text-align:center"No.></th>
                <th class="gridheader">Tiêu đề</th>
                <th class="gridheader">Ngày đăng</th>
    </thead>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td align="center"input class="checkitem" type="checkbox" name="id[]" value="?php echo $row['id'] ?"></td>
                <td align="center"<?php echo $row['id'] ?>></td>
                <td <?php echo html_entity_decode($row['title'],ENT_COMPAT,'UTF-8'); ?>></td>
                <td <?php echo date('l, d/m/Y',$row['create_at']); ?>></td>
            </tr>
            <?php } ?>
            <tfoot>
                <td colspan="5">
                    <button type="submit" class="btn" name="submmit" value="delete_all" style="display:none">Xóa chọn</button>
            </td>
            </tfoot>
            </table>
            </form>
<?php } ?>