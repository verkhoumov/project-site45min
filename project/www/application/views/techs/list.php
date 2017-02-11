<div class="container-wrapper" id="section-techs-list">
	<div class="container">
		<div class="row flex-items-xs-center">
			<div class="col-xs-12 col-md-8 col-lg-6">
				<h3 class="h2 text-xs-center">Перечень технологий</h3>
				<p class="text-xs-center">Языки программирования, фреймворки, редакторы и среды разработки, библиотеки сторонних разработчиков, CMS и многое другое.</p>
			</div>

			<div class="col-xs-12">
				<div class="tech-list">
					<div class="row">
						{list_with_image}
						<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 expand-list expand-list-tech">
							<div class="tech">
								<span class="tech-cap popup-initiator" data-modal-type="tech" data-tech-id="{id}">
									<span class="tech-name overflow">{name}</span>
								</span>

								<img src="{image}" alt="{name}">
							</div>
						</div>
						{/list_with_image}
					</div>

					<div class="separator separator-height-sm"></div>

					<div class="row flex-items-xs-center">
						<div class="col-xs-12 col-md-6 col-lg-4">
							<button class="button button-block button-expand-list" data-expand-list=".expand-list-tech" data-expand-type="open">Показать ещё</button>
						</div>
					</div>

					<div class="separator separator-height-sm"></div>
				</div>
			</div>

			<div class="col-xs-12 col-md-8 col-lg-6">
				<p class="tips text-xs-center">В общей сложности наши уроки затрагивают <br>{count}.</p>
			</div>
		</div>
	</div>
</div>