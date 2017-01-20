{% extends 'templates/base.php' %}

{% block body %}
<div class="container">
	<div class="jumbotron">
		{% if questions %}
			<form method="post" action="/submit-assessment">
				<input type="hidden" name="assessment_id" value="{{ assessment_id }}">
				<ul class="questions">
					{% for id, question in questions %}
						<li>
							<div class="question">
								<div class="question-number">
									{{ question.order }}
								</div>
								<div class="question-text">
									{{ question.question }}
								</div>
								<div class="question-toggle">
									<input type="hidden" name="answer[{{id}}]" value="NO" />
									<input class="tgl tgl-ios" name="answer[{{id}}]" id="question-{{ id }}" type="checkbox" value="YES" />
									<label class="tgl-btn pull-right" for="question-{{ id }}"></label>
								</div>
							</div>
						</li>
					{% endfor %}
				</ul>
				<input type="submit" name="submit" class="btn btn-info btn-lg" value="Submit" />
			</form>
		{% endif %}



	</div>
</div>

{% endblock %}