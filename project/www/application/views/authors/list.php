<div class="container-wrapper" id="section-team-list">
	<div class="container">
		<div class="row flex-items-xs-center">
			<div class="col-xs-12 col-md-8 col-lg-6">
				<h2 class="text-xs-center">Авторы уроков</h2>
				<p class="text-xs-center">Дизайнеры и веб-разработчики. Многие открыты к интересным предложениям о работе!</p>
			</div>

			<div class="col-xs-12">
				<div class="authors-list authors-big">
					<div class="row">
						{list}
						<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 expand-list expand-list-user">
							<div class="author popup-initiator" data-modal-type="user" data-user-id="{id}">
								<img src="{avatar}" alt="{name}">
							</div>
						</div>
						{/list}
					</div>

					<div class="separator separator-height-sm"></div>

					<div class="row flex-items-xs-center">
						<div class="col-xs-12 col-md-6 col-lg-4">
							<button class="button button-block button-expand-list" data-expand-list=".expand-list-user" data-expand-type="open">Показать ещё</button>
						</div>
					</div>

					<div class="separator separator-height-sm"></div>
				</div>
			</div>

			<div class="col-xs-12 col-md-8 col-lg-6">
				<p class="tips text-xs-center">В создании уроков {count}.</p>
			</div>
		</div>
	</div>
</div>