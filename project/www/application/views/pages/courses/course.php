<div class="container-wrapper container-dark" id="section-feedback-form">
	<div class="container">
		<div class="row flex-items-xs-center">
			<div class="col-xs-12">
				<div class="popup course-page">
					<div class="popup-inner">
						<div class="popup-group">
							<div class="row flex-items-xs-middle flex-items-xs-center flex-items-sm-between">
								<div class="col-xs-12 col-sm-6">
									<span class="course-user flex-items-xs-center flex-items-sm-left">
										<span class="course-user-avatar popup-initiator" data-modal-type="user" data-user-id="<?php echo $course['user_id']; ?>"><img src="<?php echo $course['user_avatar']; ?>" alt="<?php echo $course['user_name']; ?>"></span>
										<span class="course-user-info">
											<span class="course-user-name overflow popup-initiator" data-modal-type="user" data-user-id="<?php echo $course['user_id']; ?>"><?php echo $course['user_name']; ?></span>
											<div class="course-date"><?php echo $course['date']; ?></div>
										</span>
									</span>
								</div>
								
								<?php if (!empty($course['sources']) || !empty($course['example'])): ?>
								<div class="col-xs-12 separator separator-height hidden-sm-up"></div>
								<? endif; ?>

								<div class="col-xs-12 col-sm-6">
									<div class="button-group button-inline text-xs-center text-sm-right">
										<?php if (!empty($course['sources'])): ?>
										<a href="<?php echo $course['sources']; ?>" target="_blank" class="button button-small button-primary">Исходники</a>
										<? endif; ?>

										<?php if (!empty($course['example'])): ?>
										<a href="<?php echo $course['example']; ?>" target="_blank" class="button button-small button-success">Пример</a>
										<? endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="<?php echo $course['video']; ?>" allowfullscreen></iframe>
						</div>

						<div class="popup-group">
							<div class="popup-label course-title"><?php echo $course['title']; ?></div>
							
							<?php if (!empty($course['description'])): ?>
							<p class="popup-text"><?php echo $course['description']; ?></p>
							<? else: ?>
							<p class="popup-text">Описание урока отсутствует.</p>
							<? endif; ?>
						</div>

						<div class="popup-group">
							<div class="popup-label">Технологии</div>

							<?php if (!empty($techs)): ?>
							<div class="tag-list tag-list-inline tag-list-popup">
								{techs}<div class="tag popup-initiator" data-modal-type="tech" data-tech-id="{id}">{name}</div>{/techs}
							</div>
							<? else: ?>
							<p class="popup-text">Автор не указал список технологий, которые были использованы в данном уроке.</p>
							<? endif; ?>
						</div>

						<div class="popup-group">
							<div class="popup-label">Похожие уроки</div>
							
							<?php if (!empty($courses)): ?>
							<div class="popup-courses-list">
								{courses}
								<a href="{link}" class="popup-course-item popup-initiator" data-modal-type="course" data-course-id="{id}">
									<img src="{image}" alt="{title}">
									<span class="course-title">{title}</span>
								</a>
								{/courses}
							</div>
							<? else: ?>
							<p class="popup-text">Данный урок не имеет аналогов.</p>
							<? endif; ?>
						</div>
						
						<div class="popup-group popup-group-footer">
							<div class="row flex-items-xs-middle flex-items-xs-center flex-items-sm-between">
								<div class="col-xs-12 col-sm-6 text-xs-center text-sm-left">
									<div class="ya-share2" id="ya-share2"></div>
								</div>

								<div class="col-xs-12 separator separator-height-sm hidden-sm-up"></div>

								<div class="col-xs-12 col-sm-6 text-xs-center text-sm-right">
									<div class="rating-value"><?php echo $course['rating']; ?></div>
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
		</div>
	</div>
</div>

<script type="text/javascript">
var courseData = <?php echo json_encode($course); ?>;
</script>