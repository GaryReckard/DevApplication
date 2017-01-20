{% extends 'templates/base.php' %}

{% block body %}
<div class="container">
	<div class="jumbotron">
		
		{% if questions %}
			<ul class="questions row">
				{% for id, question in questions %}
					<li class="col-xs-12">
						<div class="row">
							<div class="col-xs-1">
								{{ question.order }}
							</div>
							<div class="col-xs-8">
								{{ question.question }}
							</div>
							<div class="col-xs-3">
								<input class="tgl tgl-ios" id="question-{{ id }}" type="checkbox"/>
								<label class="tgl-btn" for="question-{{ id }}"></label>
							</div>
						</div>
					</li>
				{% endfor %}
			</ul>
		{% endif %}

	</div>
</div>

{% endblock %}