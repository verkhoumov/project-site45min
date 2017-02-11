<!-- Информация о технологии -->
<script id="template-modal-tech" type="text/html">
	<div id="modal-tech" class="popup-wrapper" style="display: none">
		<div class="popup">
			<div class="close-button popup-close"></div>

			<div class="popup-inner scrollbar">
				<div class="popup-group">
					<div class="popup-header popup-header-tech">
						<img src="{{tech.image}}" alt="{{tech.name}}">
						<div class="popup-header-name">{{{tech.name}}}</div>

						{{#tech.link}}
						<div class="popup-header-link">
							<a href="{{tech.link}}">{{{tech.link_name}}}{{^tech.link_name}}{{tech.link}}{{/tech.link_name}}</a>
						</div>
						{{/tech.link}}
					</div>
				</div>

				<div class="popup-group">
					<div class="popup-label">Описание</div>
					
					<p class="popup-text">
					{{#tech.description}}{{{tech.description}}}{{/tech.description}}
					{{^tech.description}}Описание отсутствует.{{/tech.description}}
					</p>
				</div>

				<div class="popup-group">
					<div class="popup-label">Специалисты</div>
					
					{{#users.0}}
					<div class="authors-list authors-pile">
						{{#users}}<div class="author popup-initiator" data-modal-type="user" data-user-id="{{id}}"><img src="{{avatar}}" alt="{{name}}"></div>{{/users}}
					</div>
					{{/users.0}}

					{{^users}}Никто из пользователей не указал, что владеет данной технологией.{{/users}}
				</div>
				
				<div class="popup-group">
					<div class="popup-label">Уроки</div>
					
					{{#courses.0}}
					<div class="popup-courses-list">
						{{#courses}}
						<a href="{{link}}" class="popup-course-item popup-initiator" data-modal-type="course" data-course-id="{{id}}">
							<img src="{{image}}" alt="{{title}}">
							<span class="course-title">{{{title}}}</span>
						</a>
						{{/courses}}

						{{#main_page}}
						<div class="separator separator-height"></div>
						
						<button class="button button-success button-block find-courses" data-tech-id="{{tech.id}}" data-tech-code="{{tech.code}}">Показать все уроки</button>
						{{/main_page}}
					</div>
					{{/courses.0}}

					{{^courses}}По данной технологии нет ни одного урока.{{/courses}}
				</div>
			</div>
		</div>
	</div>
</script>