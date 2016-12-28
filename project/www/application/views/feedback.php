<div class="container-wrapper container-dark" id="section-feedback-form">
	<div class="container">
		<div class="row flex-items-xs-center">
			<div class="col-xs-12 col-md-8 col-lg-6">
				<h2 class="text-xs-center">Обратная связь</h2>
				<p class="text-xs-center">Есть вопросы или предложения? Свяжитесь с технической поддержкой, если вопрос касается сайта, или с автором любого из уроков, если речь идёт о размещённом на сайте учебном материале.</p>
			</div>

			<div class="col-xs-12 col-md-10 col-lg-8">
				<div class="wall">
					<form method="POST" id="feedback">
						<div class="form-group">
							<label class="label-required" for="form-name">Как Вас зовут?</label>
							<input type="text" class="form-control" id="form-name" name="feedback[name]" placeholder="Иван Иванов">
						</div>

						<div class="form-group">
							<label class="label-required" for="form-email">Куда следует отправить ответ?</label>
							<input type="text" class="form-control" id="form-email" name="feedback[email]" placeholder="ivan.ivanov@yandex.ru">
						</div>

						<div class="form-group">
							<label class="label-required" for="form-to">Автор урока или тех. поддержка</label>
							<select name="feedback[to]" id="select-feedback">
								<option></option>
								<option value="0" id="select-user-0">Техническая поддержка</option>
								{list}<option value="{id}" id="select-user-{id}">{name}</option>{/list}
							</select>
						</div>

						<div class="form-group">
							<label for="form-theme">Тема обращения</label>
							<input type="text" class="form-control" id="form-theme" name="feedback[theme]" placeholder="Предложение о работе">
						</div>

						<div class="form-group">
							<label class="label-required" for="form-message">Текст сообщения</label>
							<textarea class="form-control" rows="5" id="form-message" name="feedback[message]" placeholder="Мы хотели бы предложить Вам работу в крупной международной компании «MegaWeb»."></textarea>
						</div>

						<button class="button button-primary hidden-xs-down" type="submit" name="feedback[send]">Отправить</button>
						<button class="button button-primary button-block hidden-sm-up" type="submit" name="feedback[send]">Отправить</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>