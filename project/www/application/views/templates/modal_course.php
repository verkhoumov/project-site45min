<!-- Урок -->
<script id="template-modal-course" type="text/html">
	<div id="modal-course" class="popup-wrapper" style="display: none">
		<div class="popup popup-course">
			<div class="close-button popup-close"></div>

			<div class="popup-inner">
				<div class="popup-group">
					<div class="row flex-items-xs-middle flex-items-xs-center flex-items-sm-between">
						<div class="col-xs-12 col-sm-6">
							<span class="course-user flex-items-xs-center flex-items-sm-left">
								<span class="course-user-avatar popup-initiator" data-modal-type="user" data-user-id="{{course.user_id}}"><img src="{{course.user_avatar}}" alt="{{course.user_name}}"></span>
								<span class="course-user-info">
									<span class="course-user-name overflow popup-initiator" data-modal-type="user" data-user-id="{{course.user_id}}">{{course.user_name}}</span>
									<div class="course-date">{{course.date}}</div>
								</span>
							</span>
						</div>

						<div class="col-xs-12 separator separator-height hidden-sm-up"></div>

						<div class="col-xs-12 col-sm-6">
							<div class="button-group button-inline text-xs-center text-sm-right">
								{{#course.sources}}<a href="{{course.sources}}" target="_blank" class="button button-small button-primary">Исходники</a>{{/course.sources}}
								{{#course.example}}<a href="{{course.example}}" target="_blank" class="button button-small button-success">Пример</a>{{/course.example}}
							</div>
						</div>
					</div>
				</div>

				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="{{course.video}}" allowfullscreen></iframe>
				</div>

				<div class="popup-group">
					<div class="popup-label course-title">{{course.title}}</div>

					<p class="popup-text">{{{course.description}}}</p>
				</div>

				<div class="popup-group">
					<div class="popup-label">Технологии</div>

					{{#techs.0}}
					<div class="tag-list tag-list-inline tag-list-popup">
						{{#techs}}<div class="tag popup-initiator" data-modal-type="tech" data-tech-id="{{id}}">{{name}}</div>{{/techs}}
					</div>
					{{/techs.0}}

					{{^techs}}<p class="popup-text">Автор не указал список технологий, которые были использованы в данном уроке.</p>{{/techs}}
				</div>

				<div class="popup-group">
					<div class="popup-label">Похожие уроки</div>
					
					{{#courses.0}}
					<div class="popup-courses-list">
						{{#courses}}
						<a href="{{link}}" class="popup-course-item popup-initiator" data-modal-type="course" data-course-id="{{id}}">
							<img src="{{image}}" alt="{{title}}">
							<span class="course-title">{{{title}}}</span>
						</a>
						{{/courses}}
					</div>
					{{/courses.0}}
					
					{{^courses}}<p class="popup-text">Данный урок не имеет аналогов.</p>{{/courses}}
				</div>

				<div class="popup-group popup-group-footer">
					<div class="row flex-items-xs-middle flex-items-xs-center flex-items-sm-between">
						<div class="col-xs-12 col-sm-6 text-xs-center text-sm-left">
							<div class="ya-share2" id="ya-share2"></div>
						</div>

						<div class="col-xs-12 separator separator-height-sm hidden-sm-up"></div>

						<div class="col-xs-12 col-sm-6 text-xs-center text-sm-right">
							<div class="rating-value">{{course.rating}}</div>
							<div class="rating-wrapper">
								<div class="rating" data-value="1"><div class="star"></div></div>
								<div class="rating" data-value="2"><div class="star"></div></div>
								<div class="rating" data-value="3"><div class="star"></div></div>
								<div class="rating" data-value="4"><div class="star"></div></div>
								<div class="rating" data-value="5"><div class="star"></div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</script>