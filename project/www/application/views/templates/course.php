<script id="template-course" type="x-tmpl-mustache">
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
		<div class="course popup-initiator" data-modal-type="course" data-course-id="{{id}}">
			<div class="course-inner">
				<a href="{{link}}" class="course-cap">
					<span class="course-user">
						<span class="course-user-avatar"><img src="{{user_avatar}}" alt="{{user_name}}"></span>
						<span class="course-user-name overflow">{{user_name}}</span>
					</span>
					<span class="course-title">{{title}}</span>
					<span class="course-date overflow">{{date}}</span>
				</a>
				<div class="course-time">{{duration}}</div>
				<img class="hidden-xs-down" src="{{image}}" alt="{{title}}">
				<img class="hidden-sm-up" src="{{image_hd}}" alt="{{title}}">
			</div>
		</div>
	</div>
</script>