<!Doctype html>
<html lang="en">
<head>

    <!-- Metadata - static -->
    {% include 'templates/metadata/main.php' %}
    
    <!-- Metadata - dynamic -->
    {% block metadata %}{% endblock %}
    
    <!-- CSS static -->
    {% include 'templates/css/main.php' %}
    
    <!-- CSS - dynamic -->
    {% block css %}{% endblock %}
    
    <!-- Javascript Header - static -->
    {% include 'templates/js/header.php' %}
    
    <!-- Javascript Header - dynamic -->
    {% block javascript_header %}{% endblock %}
    
</head>
<body class="app-body">
    
    <!-- Header -->
    {% include 'templates/header/header.php' %}
    
    <!-- Body -->
    {% block body %}{% endblock %}
    
    <!-- Footer -->
    {% include 'templates/footer/footer.php' %}
    
    <!-- Javascript - static -->
    {% include 'templates/js/main.php' %}
    
    <!-- Javascript - dynamic -->
    {% block javascript %}{% endblock %}
    
</body>
</html>