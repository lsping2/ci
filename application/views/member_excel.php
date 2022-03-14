<?php
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=euc-kr");
header( "Content-Disposition: attachment; filename =test.xls" );
header( "Content-Description: PHP4 Generated Data" );
?>


<table width="100%" align="center" cellpadding="0" cellspacing="0" border="1">
<tr align="center" class="gray_bg">
    <td width="6%" align="center">아이디</td>
    <td width="8%" align="center">이름</td>
    <td width="8%" align="center">등록일</td>
</tr>
<?
            foreach($list as $row){
?>
            
            <tr>
                <td><?=$row->mb_id?></td>
                <td><?=$row->mb_name?></td>
                <td><?=$row->reg_date?></td>
            </tr>
    <?php
    }
    ?>
</table>