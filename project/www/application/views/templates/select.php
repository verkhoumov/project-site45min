<script id="template-select-option" type="x-tmpl-mustache">
	<img class="feedback-user-photo" src="{{avatar}}" alt="{{name}}">
	<span class="feedback-user-name overflow">{{name}}</span>
	{{#email}}<span class="feedback-user-email overflow">{{email}}</span>{{/email}}
</script>