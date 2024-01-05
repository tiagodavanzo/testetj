 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar">
	<div id="sidebar-collapse">
		<div class="admin-block d-flex">
			<div>
				<img src="./assets/img/admin-avatar.png" width="45px" />
			</div>
			<div class="admin-info">
				<div class="font-strong">Olá, <?= 'Usuário'; ?></div></div>
		</div>
		<ul class="side-menu metismenu">
			<li>
				<a <?= ($pag == 'home.php') ? 'class="active"' : ''; ?> href="index.php?pag=home"><i class="sidebar-item-icon fa fa-home"></i>
					<span class="nav-label">Home</span>
				</a>
			</li>

			<li>
				<a <?= ($pag == 'autor.php') ? 'class="active"' : ''; ?> href="index.php?pag=autor"><i class="sidebar-item-icon fa fa-user"></i>
					<span class="nav-label">Autor</span>
				</a>
			</li>

			<li>
				<a <?= ($pag == 'assunto.php') ? 'class="active"' : ''; ?> href="index.php?pag=assunto"><i class="sidebar-item-icon fa fa-envelope"></i>
					<span class="nav-label">Assunto</span>
				</a>
			</li>

			<li>
				<a <?= ($pag == 'livro.php') ? 'class="active"' : ''; ?> href="index.php?pag=livro"><i class="sidebar-item-icon fa fa-book"></i>
					<span class="nav-label">Livro</span>
				</a>
			</li>
			
			<!--<li>
				<a href="logout.php"><i class="sidebar-item-icon fa fa-sign-out"></i>
					<span class="nav-label">Logout</span>
				</a>
			</li>-->
		</ul>
	</div>
</nav>
<!-- END SIDEBAR-->