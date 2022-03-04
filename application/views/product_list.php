<script>
function search_it(){

  if( $(".search_key").val() )
  {
    form1.action="/index.php/product/lists/search_key/"+ $(".search_key").val();
  }
  else
  {
    form1.action="/index.php/product/lists";
  }
    form1.submit();
}

</script>
<div class="alert mycolor1" role="alert">상품리스트</div>

<form name="form1" method="post" action="">
<table width="100%">
<tr>
  <td width="50%">
        <input type="text" class="form-control search_key" name="search_key"  value="<?=$search_key?>">
  </td>
  <td>
         <button class="btn mycolor1" type="button" onClick="search_it();">검색</button>
  </td>

  <td align="right">
    <a href="/index.php/product/add"  class="btn btn-primary">추가</a>
  </td>
</tr>
</table>
</form>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">이미지</th>
      <th scope="col">분류</th>
      <th scope="col">상품명</th>
      <th scope="col">비용</th>
      <th scope="col">DATE</th>
    </tr>
  </thead>
  <tbody>

<? 
$loop=0;
foreach($list as $row)
{   
?>

    <tr>
      <td scope="row"><?=$total_rows - $page - $loop?></td>
      <td>
        <? if( $row->file_name ) :?>
         <img src="/file_product/<?=$row->file_name?>" width="50">
        <? endif?>
      </td>
      <td><a href="/index.php/product/view/no/<?=$row->no?>"><?=$row->gubun_name?>(<?=$row->gubun_no?>)</a></td>
      <td><a href="/index.php/product/view/no/<?=$row->no?>"><?=$row->name?></a></td>
      <td><a href="/index.php/product/view/no/<?=$row->no?>"><?=$row->price?></a></td>
      <td><?=$row->reg_date?></td>
    </tr>
<?
$loop++;
}
?>

  </tbody>
</table>

<?
echo $pagination;
?>
