<!-- Информация о пользователе -->
<script id="template-modal-user" type="text/html">
	<div id="modal-user" class="popup-wrapper" style="display: none">
		<div class="popup">
			<div class="close-button popup-close"></div>
			
			<div class="popup-inner scrollbar">
				<div class="popup-group">
					<div class="popup-header popup-header-author">
						<img src="{{user.avatar}}" alt="{{user.name}}">
						<div class="popup-header-name">{{user.name}}</div>
						
						{{#user.city}}<div class="popup-author-city">{{{user.city}}}</div>{{/user.city}}
						
						{{#contacts.personal.0}}
						<div class="popup-header-link">
							<a href="{{contacts.personal.0.link}}" target="_blank">{{{contacts.personal.0.name}}}</a>
						</div>
						{{/contacts.personal.0}}
					</div>
				</div>

				<div class="popup-group">
					<div class="popup-label">Обо мне</div>

					{{#user.about}}<p class="popup-text">{{{user.about}}}</p>{{/user.about}}
					{{^user.about}}<p class="popup-text">Пользователь не указал информацию о себе.</p>{{/user.about}}
				</div>

				<div class="popup-group">
					<div class="popup-label">Навыки</div>

					<!-- Трюк с 0 позволяет скрыть область, если массив пуст. -->
					{{#techs.0}}
					<div class="tag-list tag-list-inline tag-list-popup">
						{{#techs}}<div class="tag popup-initiator" data-modal-type="tech" data-tech-id="{{id}}">{{name}}</div>{{/techs}}
					</div>
					{{/techs.0}}

					{{^techs}}<p class="popup-text">Пользователь не сообщил о своих профессиональных навыках.</p>{{/techs}}
				</div>

				<div class="popup-group">
					<div class="popup-label">Уроки</div>

					{{#courses.0}}
					<div class="popup-courses-list">
						{{#courses}}
						<a href="{{link}}" class="popup-course-item popup-initiator" data-modal-type="course" data-course-id="{{id}}">
							<img src="{{image}}" alt="{{title}}">
							<span class="course-title">{{title}}</span>
						</a>
						{{/courses}}
					</div>
					{{/courses.0}}

					{{^courses}}
					<p class="popup-text">Пользователь не добавил ни одного урока.</p>
					{{/courses}}
				</div>

				<div class="popup-group">
					<div class="popup-label">Контакты</div>

					<div class="popup-user-links-list">
						{{#contacts.link}}
						<div class="popup-user-link-item">
							<a class="popup-user-link contact overflow" href="{{link}}" target="_blank">{{{name}}}</a>
						</div>
						{{/contacts.link}}

						{{#contacts.skype}}
						<div class="popup-user-link-item">
							<span class="popup-user-link contact skype">{{{link}}}</span>
						</div>
						{{/contacts.skype}}

						{{#contacts.email}}
						<div class="popup-user-link-item">
							<span class="popup-user-link contact email">{{{link}}}</span>
						</div>
						{{/contacts.email}}

						{{#contacts.phone}}
						<div class="popup-user-link-item">
							<span class="popup-user-link contact phone">{{{link}}}</span>
						</div>
						{{/contacts.phone}}

						{{^contacts.link}}
							{{^contacts.skype}}
								{{^contacts.email}}
									{{^contacts.phone}}<p class="popup-text">Отсутствуют.</p>{{/contacts.phone}}
								{{/contacts.email}}
							{{/contacts.skype}}
						{{/contacts.link}}
					</div>
				</div>

				{{#main_page}}
					{{#contacts.email.0}}
					<div class="popup-group">
						<button class="button button-primary button-block send-message" data-user-id="{{user.id}}">Написать сообщение</button>
					</div>
					{{/contacts.email.0}}
				{{/main_page}}
			</div>
		</div>
	</div>
</script>