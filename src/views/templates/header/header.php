<!-- Fixed Top Navbar -->
<div class="navbar navbar-fixed-top">

	<div class="container">
		
		<!-- Navbar Header -->
		<div class="navbar-header col-sm-4 col-md-4 col-lg-4">
			
			<a class="navbar-brand">
				VJS <strong>Ass</strong>essment
			</a>			
		</div>

		{% if logged_in %}
			<div class="navbar-form navbar-right">
				<a href="/logout" type="button" class="btn btn-info btn-sm pull-right">
					<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out
				</a>
			</div>


		{% endif %}
		
	</div>

</div>
{% if flash %}
	<div class="container">
		{% for type, message in flash %}
			<div class="alert alert-{{ type }}" role="alert">
				{{ message }}
			</div>
		{% endfor %}
	</div>
{% endif %}