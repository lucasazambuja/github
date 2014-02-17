<?php require_once('../wp-config.php'); ?>
<?php include_once('functions_admin.php'); ?>

<!doctype html>
 
<html lang="en">
<head>

  <meta charset="utf-8" />
  <title>Admarea</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="http://localhost/anfitriawordpress/admarea/style/admarea.css" />
  <link rel="stylesheet" href="http://localhost/anfitriawordpress/admarea/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="http://localhost/anfitriawordpress/admarea/bootstrap/datepicker/css/datepicker.css" />
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
   <script type="text/javascript" src="bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="js/admarea.js"></script>
  
</head>

<body>

	<div class="container-fluid">

		<h1>Admarea</h1>
		<hr>
		<div class="row">

			<div class="col-md-6">
				<label for="category_id">Selecione uma categoria</label>
				<select name="category_id" id="category_id" class="form-control input-lg" data-url="">
					<option value="0">Selecione uma cateogria</option>
					<option value="1">category title</option>
					<option value="2">category title</option>
					<option value="3">category title</option>
					<option value="4">category title</option>
					<option value="5">category title</option>
					<option value="6">category title</option>
				</select>
				<p class="help-block"><a href="#">Criar Cagetoria</a></p>
			</div>

			<div class="col-md-6">
				<label for="post_id">Selecione um post</label>
				<select name="post_id" id="post_id" class="form-control input-lg" data-url="">
					<option value="0">Selecione uma cateogria</option>
					<option value="1">category title</option>
					<option value="2">category title</option>
					<option value="3">category title</option>
					<option value="4">category title</option>
					<option value="5">category title</option>
					<option value="6">category title</option>
				</select>
				<p class="help-block"><a href="#">Criar Post</a></p>
			</div>

		</div>

		<?php if (true) : ?>

			<div class="row">

				<div class="col-md-6">
					<form action="" id="post-form" name="post-form" method="post">

						<div class="form-group">
							<label for="sub_category">Selecione uma sub Cateogria</label>
							<select name="sub_category" id="sub_category" class="form-control">
								<option value="0">Selecione uma sub Cateogria</option>
								<option value="1">sub category title</option>
								<option value="2">sub category title</option>
								<option value="3">sub category title</option>
								<option value="4">sub category title</option>
								<option value="5">sub category title</option>
								<option value="6">sub category title</option>
							</select>
							<p class="help-block"><a href="#">Crie uma sub categoria</a></p>
						</div>

						<div class="form-group">
							<label for="post_title">Titulo do Post</label>
							<input type="text" id="post_title" name="post_title" class="form-control">
						</div>

						<div class="form-group">
							<label for="post_text">Texto do Post</label>
							<textarea name="post_text" id="post_text" class="form-control tinymce"></textarea>
						</div>

						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label for="post_like">Gostaram</label>
									<input type="text" id="post_like" name="post_like" class="form-control">
								</div>	
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="post_date">Data</label>
									<input type="text" id="post_date" name="post_date" class="form-control datepicker">
								</div>
							</div>

						</div>

						<!-- Button trigger modal -->
						<a class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal" href="#">
						  inserir imagem
						</a>

						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
						      </div>

						      <div class="modal-body">

							      	<div id="modal-select" class="row selectable">
										
										<div class="col-md-2 element-modal" id="10">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084673.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/100x100">
		   									</a>
		   								</div>

		   								<div class="col-md-2 element-modal" id="11">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084673.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/100x100">
		   									</a>
		   								</div>

		   								<div class="col-md-2 element-modal" id="12">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084673.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/100x100">
		   									</a>
		   								</div>

		   								<div class="col-md-2 element-modal" id="13">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084673.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/100x100">
		   									</a>
		   								</div>

		   								<div class="col-md-2 element-modal" id="14">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084673.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/100x100">
		   									</a>
		   								</div>

									</div>
						        
						      </div>

						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button type="button" id="add_imagem_thumb" class="btn btn-primary">Save changes</button>
						      </div>

						    </div>
						  </div>
						</div>

						<br><br>

						<div class="row">
							
							<div class="col-md-12">

								<div class="jumbotron">

									<div id="sortable-thumb" class="row sortable">
										
										<div class="col-md-3 element-sort" id="1">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084823.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">
		   									</a>
		   								</div>

		   								<div class="col-md-3 element-sort" id="2">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084823.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">
		   									</a>
		   								</div>

		   								<div class="col-md-3 element-sort" id="3">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084823.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">
		   									</a>
		   								</div>

		   								<div class="col-md-3 element-sort" id="4">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084823.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">
		   									</a>
		   								</div>

		   								<div class="col-md-3 element-sort" id="5">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084823.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">
		   									</a>
		   								</div>

		   								<div class="col-md-3 element-sort" id="6">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084823.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">
		   									</a>
		   								</div>

		   								<div class="col-md-3 element-sort" id="7">
											<a href="#" class="thumbnail relative">
												<div class="mask" style="background: url('http://anfitria.com.br/wp-content/uploads/2013/10/anfitria_1381084823.jpg') no-repeat center;background-size: auto 100%;"></div>
										        <img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">
		   									</a>
		   								</div>

		   								<input type="hidden" name="order_thumbnail" id="order_thumbnail" class="form-control" value="">

									</div>

								</div>
							</div>

						</div>

						<?php if (true) : ?>

							<input type="submit" name="post_creat" id="post_creat" value="Salvar" class="btn btn-success">

						<?php else : ?>

							<input type="submit" id="post_update" class="btn btn-primary" name="post_update" value="Salvar Alteração">
							<input type="submit" id="post_delete" class="btn btn-danger" name="post_delete" value="Delet">

						<?php endif; ?>


					</form>
				</div>

				<div class="col-md-6">

					<div class="row">

						<div class="col-md-12">
						
							<div class="table-responsive">
						      <table class="table table-bordered text-center admarea-table-nav">
						        <tbody>

						          <tr>
						            <td><a href="#">Ver comentarios</a></td>
						            <td><a href="#">Destaque</a></td>
						            <td><a href="#">Links</a></td>
						            <td><a href="#">Fotos</a></td>
						          </tr>

						          <tr>
						            <td><a href="#">Estatisca</a></td>
						            <td><a href="#">Backup</a></td>
						            <td><a href="#">Sorteio</a></td>
						            <td><a href="#">Tabela</a></td>
						          </tr>

						        </tbody>
						      </table>
						    </div>

						</div>

					</div>

				</div>

			</div>

		<?php endif; ?>

	</div>

</body>

</html>