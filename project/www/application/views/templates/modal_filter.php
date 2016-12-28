<!-- Фильтры -->
<div id="modal-filter" class="popup-wrapper" style="display: none">
	<div class="popup popup-filter">
		<div class="close-button popup-close"></div>
		
		<div class="popup-inner">
			<div class="filter-selector">
				<div class="filter-list scrollbar">
					<div class="tag-list tag-list-column no-margin" id="modal-filter-inactive">
						{list}<div class="tag" data-id="{id}" data-code="{code}">{name}</div>{/list}
					</div>
				</div>

				<div class="filter-list scrollbar">
					<div class="tag-list tag-list-column no-margin" id="modal-filter-active"></div>
				</div>
			</div>

			<div class="popup-group filter-buttons">
				<button type="submit" class="button button-small popup-close">Отменить</button>
				<button type="submit" class="button button-small button-success">Принять</button>
			</div>
		</div>
	</div>
</div>