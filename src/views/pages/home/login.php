{% extends 'templates/base.php' %}

{% block body %}
<div class="container">
	<div class="jumbotron">
		<form class="form-signin" method="post" action="/login">
			<h1 class="form-signin-heading text-muted">Sign In</h1>

			<input type="text" class="form-control" placeholder="Username" required="" autofocus="" name="username">
			<input type="password" class="form-control" placeholder="Password" required="" name="password">
			<button class="btn btn-lg btn-primary btn-block" type="submit">
				Sign In
			</button>
		</form>
	</div>
</div>

{% endblock %}