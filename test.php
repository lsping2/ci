<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	 <link rel="stylesheet" href="/css/style.css"> 

	 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    <title>Hello, world!</title>
  </head>



	<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">관리자</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav mr-auto"> <!--mr-auto 메뉴 양끝으로 배치 -->
		  <li class="nav-item active">
			<a class="nav-link" href="#">Home </a>
		  </li>


		   <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  메뉴1
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item" href="#">하위1</a>
			  <a class="dropdown-item" href="#">하위2</a>

			  <div class="dropdown-divider"></div>

			  <a class="dropdown-item" href="#">하위3</a>

			</div>
		  </li>


		  <li class="nav-item">
			<a class="nav-link" href="#"> 메뉴2</a>
		  </li>

		  <li class="nav-item">
			<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"> 메뉴3</a>
		  </li>
		</ul>

		<a class="btn btn-sm-outline-secondary btn-dark" href="#">로그인</a>
	  </div>
	</nav>
     <br>





<div class="alert mycolor1" role="alert">서브타이틀</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>


<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm justify-content-center"><!--pagination-sm 글자줄이기--><!-- justify-content-center 가운데 정렬 -->
	<li class="page-item"><a class="page-link" href="#">Previous</a></li>
	<li class="page-item active"><a class="page-link" href="#">1</a></li>
	<li class="page-item"><a class="page-link" href="#">2</a></li>
	<li class="page-item"><a class="page-link" href="#">3</a></li>
	<li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>




	<form>
	  <div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" class="form-control" id="exampleInputPassword1">
	  </div>
	  <div class="form-group form-check">
		<input type="checkbox" class="form-check-input" id="exampleCheck1">
		<label class="form-check-label" for="exampleCheck1">Check me out</label>
	  </div>
	  <button type="submit" class="btn btn-primary">등록</button>
	</form>

</div>
   

</html>