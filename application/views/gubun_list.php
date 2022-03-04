<script>
function search_it(){

  if( $(".search_key").val() )
  {
    form1.action="/index.php/gubun/lists/search_key/"+ $(".search_key").val();
  }
  else
  {
    form1.action="/index.php/gubun/lists";
  }
    form1.submit();
}

</script>
<div class="alert mycolor1" role="alert">분류관리</div>

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
    <a href="/index.php/gubun/add"  class="btn btn-primary">추가</a>
  </td>
</tr>
</table>
</form>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">분류명</th>
      <th scope="col">등록일</th>
    </tr>
  </thead>
  <tbody>

<? 
$loop=0;
foreach($list as $row)
{   
?>

    <tr>
      <th scope="row"><?=$total_rows - $page - $loop?></th>
      <td><a href="/index.php/gubun/view/no/<?=$row->no?>"><?=$row->name?></a></td>
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
