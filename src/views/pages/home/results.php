{% extends 'templates/base.php' %}

{% block body %}
<div class="container">
	<div class="jumbotron">
		{% if results %}

			{% for style, yesses in results %}
				{{ style }} - {{ yesses }} <br >
			{% endfor %}

			<a href="/" type="button" class="btn btn-info btn-lg">
				Take Assessment Again?
			</a>

		{% endif %}
	</div>
</div>

{% endblock %}