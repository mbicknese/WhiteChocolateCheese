<header class="text-center">
	<h1>Feestje 2016</h1>
	<p class="h2">Schrijf je in</p>
</header>
<?= $this->Session->flash(); ?>
<main class="well">
	<form method="POST" action="users/login">
		<div class="form-group">
			<input name="data[User][password]" placeholder="code" type="text" class="form-control" />
		</div>
		<input type="submit" class="btn btn-primary btn-block" value="Login" />
	</form>
</main>
