<html>
<head>
	<title> Learning Backbone js</title>
	<script src="js/underscore.js" type="text/javascript"></script>
	<script src="js/Jquery.js" type="text/javascript"></script>
	<script src="js/backbone.min.js" type="text/javascript"></script>

	

</head>

<body>
	<h1> Learning Backbone js </h1>
	<form id="new-tweet">
		<label>Author:</label><input id="author-name" name="author-name" type="text" />
		<label>Status:</label><input id="status-update" name="status-update" type="text" />
		<button>Post</button>
	</form>
	<hr />
	<div id="tweets-container"></div>
	<script src="js/jsBackboneHandler.js" type="text/javascript"></script>
	<script type="text/template" id="tweet-template">
		<span class="author"><%= author %>:</span>
		<span class="status"><%= status %></span>
		<a href="#" class="edit">[edit]</a>
		<a href="#" class="delete">[delete]</a>
	</script>
</body>

</html>