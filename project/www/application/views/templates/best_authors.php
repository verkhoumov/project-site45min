<!-- Урок -->
<script id="template-modal-best-authors" type="text/html">
{{#users}}
<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
	<div class="author popup-initiator" data-modal-type="user" data-user-id="{{id}}">
		<img src="{{avatar}}" alt="{{name}}">
	</div>
</div>
{{/users}}

{{^users}}<p class="tips text-xs-center">Список лучших авторов не определён.</p>{{/users}}
</script>