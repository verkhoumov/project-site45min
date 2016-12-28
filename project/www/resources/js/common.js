/**
 *  Настройки для нотификатора.
 */
var notifySettings = {
	layout: 'topRight',
    type: 'alert',
    theme: 'bootstrapTheme',
    template: '<div class="noty_message"><span class="noty_text"></span></div>',
    animation: {
        open: 'animated bounceInRight',
        close: 'animated bounceOutRight',
        easing: 'swing',
        speed: 500
    },
    timeout: 5000
};

/**
 * Склонение существительного на основе полученного числа.
 * @param  {integer} n  Число
 * @param  {string} n1 [1 "яблоко"]
 * @param  {string} n2 [2 "яблока"]
 * @param  {string} n5 [5 "яблок"]
 * @return {string}
 */
var getNounWord = function(n, n1, n2, n5) {
	// Целое число.
	n = Math.abs(n);

	// Результат: 5 яблок.
	n %= 100;
	if (n >= 5 && n <= 20) {
		return n5;
	}

	// Результат: 1 яблоко.
	n %= 10;
	if (n == 1) {
		return n1;
	}

	// Результат: 2 яблока.
	if (n >= 2 && n <= 4) {
		return n2;
	}

	return n5;
};

/**
 *  Менеджер фильтров.
 */
(function($) {
	$.fn.filterManager = function(filter_in) {
		return this.each(function() {
			var $this = $(this);

			var filters = {},
				inactive = {},
				active = {},
				new_inactive = {},
				new_active = {};

			var $modal = $(this),
				$modal_inactive = $(this).find('#modal-filter-inactive'),
				$modal_active = $(this).find('#modal-filter-active'),
				$filters_list = $('#courses-filters');

			var counter = 0,
				positions = {};
			
			init();
			
			/**
			 *  Инициализация менеджера.
			 */
			function init()
			{
				deactivateAllFilters();
				getInactiveFilters();
				setFiltersPosition();
				activateInputFilters();

				updateFiltersList();
				updateScrollbar();

				bindInactiveFilters();
				bindActiveFilters();

				// Обновляем список уроков.
				$(document).coursesManager(0, 6, getFiltersCode(active));
			};

			/**
			 *  Деактивация всех активных фильтров.
			 */
			function deactivateAllFilters()
			{
				$modal_active.children('.tag').each(function(index) {
					$(this).removeClass('active').appendTo($modal_inactive);
				});
			};

			/**
			 *  Запоминание позиции технологии в списке фильтров.
			 */
			function setFiltersPosition()
			{
				for (var code in filters)
				{
					if (typeof positions[code] === 'undefined') {
						positions[code] = ++counter;
					}
				}
			}

			/**
			 *  Активация фильтров, переданных в аргументе filter_in.
			 */
			function activateInputFilters()
			{
				for (var code in inactive) {
					filter_in.map(function(filter_in_code) {
						if (filter_in_code == code) {
							$(inactive[code].element).addClass('active').appendTo($modal_active);

							active[code] = inactive[code];
							delete inactive[code];

							new_active[code] = cloneObject(active[code]);
							new_inactive[code] = cloneObject(inactive[code]);
						}
					});
				}
			};

			/**
			 *  Получение информации о фильтре из data-.
			 */
			function getFilterData(object)
			{
				return {
					id: $(object).data('id'),
					code: $(object).data('code'),
					name: $(object).text(),
					element: object
				};
			};

			/**
			 *  Формирование списка неактивных фильтров.
			 */
			function getInactiveFilters()
			{
				return $modal_inactive.children('.tag').each(function(index, element) {
					var filter = getFilterData(element);

					filters[filter.code] = filter;
					inactive[filter.code] = filter;
				});
			};

			/**
			 *  Формирование списка активных фильтров.
			 */
			function getActiveFilters()
			{
				return $modal_active.children('.tag').each(function(index, element) {
					var filter = getFilterData(element);

					active[filter.code] = filter;
				});
			};

			/**
			 *  Обновление списка фильтров для поиска уроков.
			 */
			function updateFiltersList() {
				// Убираем фильтры.
				$filters_list.children('.tag').remove();

				// Добавляем активные фильтры.
				for (var code in active) {
					$(active[code].element).clone().prependTo($filters_list);
				}
			};

			/**
			 *  Биндинг событий на неактивные фильтры.
			 */
			function bindInactiveFilters() {
				unbindInactiveFilters();

				return $modal_inactive.on('click', '.tag', function() {
					var filter = getFilterData($(this));

					// Добавляем в список активных из списка неактивных.
					new_active[filter.code] = new_inactive[filter.code];
					$(this).addClass('active').appendTo($modal_active);

					// Удаляем из списка неактивных.
					delete new_inactive[filter.code];

					// Перебиндинг фильтров в новом составе.
					bindInactiveFilters();
					bindActiveFilters();

					// Обновляем скроллбар.
					updateScrollbar();
				});
			};

			/**
			 *  Снятие биндинга.
			 */
			function unbindInactiveFilters() {
				return $modal_inactive.off('click', '.tag');
			};

			/**
			 *  Биндинг событий для активных фильтров.
			 */
			function bindActiveFilters() {
				unbindActiveFilters();

				return $modal_active.on('click', '.tag', function() {
					var filter = getFilterData($(this));

					// Добавляем в список неактивных из списка активных.
					new_inactive[filter.code] = new_active[filter.code];

					// Когда деактивируем фильтр, размещаем его на старом месте.
					if (positions[filter.code] > (Object.keys(new_inactive).length - 1))
					{
						$(this).removeClass('active').appendTo($modal_inactive);
					}
					else if (positions[filter.code] == 1)
					{
						$(this).removeClass('active').prependTo($modal_inactive);
					}
					else
					{
						$(this).removeClass('active').insertAfter($modal_inactive.children(':nth-child(' + (positions[filter.code] - 1) + ')'));
					}

					// Удаляем из списка активных.
					delete new_active[filter.code];

					// Перебиндинг фильтров в новом составе.
					bindInactiveFilters();
					bindActiveFilters();

					// Обновляем скроллбар.
					updateScrollbar();
				});
			};

			/**
			 *  Снятие биндинга.
			 */
			function unbindActiveFilters() {
				return $modal_active.off('click', '.tag');
			};

			/**
			 *  Обновление скроллбара.
			 */
			function updateScrollbar() {
				return $modal.find('.scrollbar').perfectScrollbar({
					suppressScrollX: true
				}).perfectScrollbar('update');
			};

			/**
			 *  При отмене/закрытии возвращаем все фильтры на исходные места.
			 */
			function rebuildFilters() {
				// Переносим объекты обратно на свои места.
				for (var code in inactive) {
					$(inactive[code].element).removeClass('active').detach().appendTo($modal_inactive);
				}

				for (var code in active) {
					$(active[code].element).addClass('active').detach().appendTo($modal_active);
				}
			};

			/**
			 *  Клонирование объекта.
			 */
			function cloneObject(object) {
				var clone = {};

				for (var key in object) {
					clone[key] = object[key];
				}

				return clone;
			};

			/**
			 *  Формирование массива со списком кодовых имён технологий.
			 */
			function getFiltersCode(filters) {
				var filter_in = [];

				for (var key in filters) {
					filter_in.push(filters[key].code);
				}

				return filter_in;
			};

			/**
			 *  Принять изменения.
			 */
			$modal.off('click', '.button-success');

			$modal.on('click', '.button-success', function() {
				inactive = cloneObject(new_inactive);
				active = cloneObject(new_active);

				// Обновление списка фильтров.
				updateFiltersList();

				// Обновляем список уроков.
				$(document).coursesManager(0, 6, getFiltersCode(active));

				$modal.modal().close();
			});

			/**
			 *  Обработчики модального окна с фильтрами.
			 */
			$modal.modal({
				cloning: false,

				// Открытие.
				onOpen: function() {
					getInactiveFilters();
					getActiveFilters();

					new_inactive = cloneObject(inactive);
					new_active = cloneObject(active);

					$modal.off('click', '.popup-close');

					$modal.on('click', '.popup-close', function(e) {
						// Отмена действия по-умолчанию.
						e.preventDefault();

						// Закрываем модальное окно.
						$(this).parents('.popup-wrapper').modal().close();
					});
				},

				// Закрытие.
				onClose: function() {
					new_inactive = {};
					new_active = {};

					rebuildFilters();
				}
			});

			return this;
		});
	};
}) (jQuery);

/**
 *  Менеджер уроков.
 */
(function($) {
	$.fn.coursesManager = function(offset, limit, filter_in) {
		return this.each(function() {
			var $courses = $(this).find('#courses-list'),
				$courses_count = $(this).find('#courses-count'),
				$courses_button = $(this).find('#courses-more-button'),
				$best_authors = $(this).find('#best-authors-list');

			var default_limit = 6,
				counter = 0;

			if (typeof offset === 'undefined') offset = 0;
			if (typeof limit === 'undefined') limit = default_limit;
			if (typeof filter_in === 'undefined') filter_in = [];

			init();

			/**
			 *  Инициализация.
			 */
			function init()
			{
				clearCoursesList();
				clearMoreButton();
				getCoursesList(offset, limit, filter_in);
				bindMoreButton();
			}

			/**
			 *  Скрытие кнопки "Загрузить ещё".
			 */
			function clearMoreButton()
			{
				$courses_button.removeClass('active');
			}

			/**
			 *  Подключение события нажатия на кнопку "Загрузить ещё".
			 */
			function bindMoreButton()
			{
				$courses_button.off('click.more');

				$courses_button.on('click.more', function(e) {
					e.preventDefault();
					getCoursesList(counter, limit, filter_in);
				});
			}

			/**
			 *  Обновление состояния кнопки "Загрузить ещё" в зависимости
			 *  от кол-ва загруженных уроков.
			 */
			function updateMoreButton(count, maximum)
			{
				if (count >= maximum) $courses_button.removeClass('active');
				else $courses_button.addClass('active');
			}

			/**
			 *  Очистка списка уроков.
			 */
			function clearCoursesList()
			{
				return $courses.empty();
			}

			/**
			 *  Обновление количества загруженных уроков.
			 */
			function updateCoursesCount(count, maximum)
			{
				var result = 'Уроков не найдено';

				if (count > 0)
				{
					// "Найдено".
					word_finded = getNounWord(count, 'Загружен ', 'Загружено ', 'Загружено ');

					// "Уроков".
					word_courses = getNounWord(count, ' урок', ' урока', ' уроков');

					// "из Х".
					word_by = ' из ' + maximum;

					result = word_finded + count + word_courses + word_by;
				}

				$courses_count.html(result);
			}

			/**
			 *  Добавление уроков в список на сайте.
			 */
			function setCoursesList(courses)
			{
				// Шаблон.
				var template = $('#template-course').html();
				Mustache.parse(template);

				courses.map(function(course) {
					tmpl = Mustache.render(template, course);
					$courses.append($(tmpl));
				});
			}

			/**
			 *  Обновлением блока "Авторы лучших уроков по выбранным технологиям".
			 */
			function updateBestAuthors(authors)
			{
				// Шаблон.
				var template = $('#template-modal-best-authors').html();
				Mustache.parse(template);

				var render = Mustache.render(template, {users: authors});
				$best_authors.html($(render));
			}

			/**
			 *  Загрузка списка уроков.
			 */
			function getCoursesList(offset, limit, filter_in)
			{
				var notify,
					status = 400,
					result = {};

				notifySettings.type = '';
				notifySettings.text = '';

				// Запрос данных через AJAX.
				$.ajax({
					url: '/Ajax/getCoursesList',
					data: {
						offset: offset,
						limit: limit,
						filter_in: filter_in
					},
					success: function(json) {
						// Код ответа.
						if (typeof json.status !== 'undefined')
						{
							status = json.status;
						}

						// Запрос успешно совершён.
						if (status == 200)
						{
							result = json;
						}
						else
						{
							notifySettings.type = 'error';
							notifySettings.text = 'По заданному запросу не было найдено ни одного урока!';
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						notifySettings.type = 'error';
						notifySettings.text = 'Во время загрузки уроков произошла неизвестная ошибка!';
					},
					complete: function() {
						if (typeof notifySettings.text !== 'undefined' && notifySettings.text != '')
						{
							notify = noty(notifySettings);
						}

						if (status == 200)
						{
							// Увеличиваем кол-во загруженных уроков.
							counter += result.courses.length;

							setCoursesList(result.courses);
							updateMoreButton(counter, result.courses_count);
							updateCoursesCount(counter, result.courses_count);
							updateBestAuthors(result.best_authors);
						}
						else
						{
							updateCoursesCount(counter, counter);
						}
					}
				});
			}
		});
	};
}) (jQuery);

/**
 *  Обработка рейтинга.
 */
(function($) {
	$.fn.Rating = function(course_id, rating, storage)
	{
		return this.each(function()
		{
			var $this = $(this),
				$stars = $this.find('.rating-wrapper > .rating');

			init();

			/**
			 *  Инициализация плагина.
			 */
			function init()
			{
				// Обновляем рейтинг при инициализации.
				updateRating(rating);

				// Бинд на выставление оценок уроку.
				bindRatingChanger();
			}

			/**
			 *  Обновление рейтинга урока в модальном окне после голосования.
			 */
			function updateRating(rating_value)
			{
				var i = getRatingStars(rating_value);

				// Меняем состояние звёзд.
				$stars.each(function() {
					// Деактивируем каждую звезду.
					$(this).children().removeClass('star-active');

					// Активируем только нужные.
					if (i > 0) $(this).children().addClass('star-active');

					i--;
				});

				// Меняем значение рейтинга.
				if (typeof rating_value !== 'undefined')
				{
					$this.find('.rating-value').text(rating_value);
				}
			};

			/**
			 *  Получение кол-ва активных звёзд по рейтингу урока.
			 */
			function getRatingStars(value)
			{
				return Math.floor(value);
			};

			/**
			 *  Активация события голосования за урок.
			 */
			function bindRatingChanger()
			{
				$stars.on('click.rating', function(e) {
					e.preventDefault();

					var value = $(this).data('value');

					sendVote(course_id, value);
				});
			}

			/**
			 *  Деактивация события голосования за урок.
			 */
			function unbindRatingChanger()
			{
				$stars.off('click.rating');
			}

			/**
			 *  Сохранение голоса пользователя, чтобы запретить повторное голосование.
			 */
			function getUserVotes()
			{
				var votes = Cookies.getJSON('votes');

				if (typeof votes === 'undefined') return {};
				else return votes;
			}

			/**
			 *  Проверка, голосовал ли пользователь за текущий урок ранее?
			 */
			function isVote(course_id)
			{
				var votes = getUserVotes();

				if (typeof votes[course_id] === 'undefined') return false;
				else return true;
			}

			/**
			 *  Сохраниение голосва пользователя за урок в Cookies.
			 */
			function saveVote(course_id, stars)
			{
				var votes = getUserVotes();

				// Первое голосование.
				if (!isVote(course_id))
				{
					votes[course_id] = stars;
					Cookies.set('votes', votes);
				}
			}

			/**
			 *  Отправка голоса на сервер для последующей обработки.
			 */
			function sendVote(id, value)
			{
				var notify,
					status = 400,
					result = {};

				notifySettings.type = '';
				notifySettings.text = '';

				if (isVote(id))
				{
					notifySettings.type = 'error';
					notifySettings.text = 'Вы уже оценили данный урок!';
					notify = noty(notifySettings);

					return;
				}

				// Запрос данных через AJAX.
				$.ajax({
					url: '/Ajax/setCourseRating',
					data: {
						course_id: id,
						rating: value
					},
					success: function(json) {
						// Код ответа.
						if (typeof json.status !== 'undefined')
						{
							status = json.status;
						}

						// Запрос успешно совершён.
						if (status == 200)
						{
							result = json;

							notifySettings.type = 'success';
							notifySettings.text = 'Спасибо за Вашу оценку!';
						}
						else
						{
							notifySettings.type = 'error';
							notifySettings.text = 'Ошибка! Не удалось зафиксировать оценку!';
						}
					},
					complete: function() {
						if (typeof notifySettings.text !== 'undefined' && notifySettings.text != '')
						{
							notify = noty(notifySettings);
						}

						if (result.status == 200)
						{
							updateRating(result.course_rating);

							// Переписываем рейтинг урока.
							storage.course[id].course.rating = result.course_rating;

							// Запоминаем голос.
							saveVote(id, result.course_rating);
						}
					}
				});
			}
		});
	};
}) (jQuery);

/**
 *  Основные скрипты.
 */
$(document).ready(function() {
	// При загрузке страницы она остаётся наверху.
	$(window).on('load', function() {
		var element = location.hash;

		// Если переместиться к объекту нельзя, 
		// оставляем страницу в самом верху.
		if (!scrollToSection(element))
		{
			$('html, body').animate({scrollTop: 0});
		}
	});

	/**
	 *  Настройки по-умолчанию для AJAX-запросов.
	 */
	$.ajaxSetup({
		type: "POST",
		dataType: "json",
		error: function(jqXHR, textStatus, errorThrown) {
			notifySettings.type = 'error';
			notifySettings.text = 'Во время запроса произошла неизвестная ошибка! Пожалуйста, повторите попытку позже.';
		}
	});

	// Хранилище данных, которые загружались ранее через AJAX.
	var storage = {
		user: {},
		course: {},
		tech: {}
	};

	// Является ли текущая страница главной?
	var main_page = true;

	// Действия при открытии модального окна.
	var modalOnOpen = function(overlay, localOptions)
	{
		// Биндинг кнопки закрытия модального окна.
		$(overlay).on('click', '.popup-close', function(e) {
			// Отмена действия по-умолчанию.
			e.preventDefault();

			// Закрываем модальное окно.
			$(this).parents('.popup-wrapper').modal().close();

			// Открываем предыдщуее окно.
			openPreviousModal();
		});

    	// Обновление скроллбара.
		$(overlay).find('.scrollbar').perfectScrollbar({
			suppressScrollX: true
		}).perfectScrollbar('update');
	}

	// Действия при закрытии модального окна.
	var modalOnClose = function(overlay, localOptions)
	{
		// Снять обработку закрытия модального окна.
		$(overlay).find('.popup-close').off('click');
	}

	/**
	 *  Настройки по-умолчанию для модальных окон.
	 */
	$.modal({
	    onOpen: function(overlay, localOptions) {
	    	modalOnOpen(overlay, localOptions);
		},
		onClose: function(overlay, localOptions) {
			modalOnClose(overlay, localOptions);
		}
	});

	// История открытия модальных окон.
	var history = [];

	// Шаблоны модальных окон.
	var templates = {
		'user': '#template-modal-user',
		'course': '#template-modal-course',
		'tech': '#template-modal-tech',
		'filter': '#modal-filter'
	};

	// Открытие модального окна через AJAX-запрос в getModalData().
	var openModal = function(type, id)
	{
		if (type == 'filter') $(templates[type]).modal().open();
		else if (type == 'user') getModalData(id, type, renderModal, 'getUser');
		else if (type == 'course') getModalData(id, type, renderModal, 'getCourse');
		else if (type == 'tech') getModalData(id, type, renderModal, 'getTech');

		return;
	};

	// Откытие предыдущего модального окна.
	var openPreviousModal = function()
	{
		var length = history.length;

		if (length < 2)
		{
			return history.pop();
		}

		var modal = history[length - 2];

		history.pop();
		history.pop();

		openModal(modal.modal_type, modal.document_id);

		return;
	};

	// Показ индикатора загрузки данных при AJAX-запросе.
	var showLoader = function()
	{
		$('#modal-loader').addClass('active');
	};

	// Скрытие индикатора загрузки.
	var hideLoader = function()
	{
		$('#modal-loader').removeClass('active');
	};

	// AJAX-запрос на получение информации 
	// о пользователе, технологии или уроке.
	var getModalData = function(id, type, callback, link)
	{
		var notify,
			status = 400,
			result = {};

		notifySettings.type = '';
		notifySettings.text = '';

		// Поиск ранее сохранённых данных.
		if (typeof storage[type][id] !== 'undefined')
		{
			return callback(type, storage[type][id]);
		}

		// Запрос данных через AJAX.
		$.ajax({
			url: '/Ajax/' + link,
			data: {
				document_id: id
			},
			beforeSend: function() {
				// Запускаем показ загрузки.
				showLoader();
			},
			success: function(json) {
				// Код ответа.
				if (typeof json.status !== 'undefined')
				{
					status = json.status;
				}

				// Запрос успешно совершён.
				if (status == 200)
				{
					result = json;
				}
				else
				{
					notifySettings.type = 'error';

					if (type == 'user') notifySettings.text = 'Пользователь не найден!';
					else if (type == 'tech') notifySettings.text = 'Информация о технологии не найдена!';
					else if (type == 'course') notifySettings.text = 'Урок не найден!';
				}
			},
			complete: function() {
				// Запускаем показ загрузки.
				hideLoader();

				if (typeof notifySettings.text !== 'undefined' && notifySettings.text != '')
				{
					notify = noty(notifySettings);
				}

				// Callback-функция для запуска рендеринга модального окна.
				callback(type, result);
			}
		});
	};

	// Функция для добавления социальных кнопок.
	var getYandexShare = function(data)
	{
		// Яндекс говорит на языке старой школы и только на нём.
		var myShare = document.getElementById('ya-share2');

		Ya.share2(myShare, {
			content: {
				title: data.title,
				description: data.description,
				image: data.image_hd,
				url: data.link
			},
			theme: {
				services: 'vkontakte,facebook,odnoklassniki,gplus,twitter'
			}
		});
	};

	// Рендеринг модального окна на основе имеющихся данных.
	var renderModal = function(type, data)
	{
		// Проверка наличия данных.
		if (!Object.keys(data).length)
		{
			return;
		}

		// Шаблон.
		var template = $(templates[type]).html();

		// Статус текущей страницы, чтобы можно было
		// уберать кнопки поиска с шаблонов.
		data.main_page = main_page;

		// Рендеринг.
		Mustache.parse(template);
		modal = Mustache.render(template, data);

		// Открытие.
		$(modal).modal({
			onOpen: function(overlay, localOptions)
			{
				modalOnOpen(overlay, localOptions);

				if (type == 'course')
				{
					// Подключаем Yandex.Share.
					getYandexShare(data.course);

					// Вешаем обработку рейтинга.
					$(overlay).Rating(data.course.id, data.course.rating, storage);

					// Подставляем новый адрес страницы для урока.
					History.pushState(null, data.course.title, data.course.link);

					// Такой трюк позволит при закрытии модального окна с уроком откатить
					// адрес страницы на предыдущий, чтобы не было багов.
					$(overlay).on('click', '.popup-initiator', function(e) {
						e.preventDefault();

						History.back();
					});
				}
			},
			onClose: function(overlay, localOptions)
			{
				modalOnClose(overlay, localOptions);

				if (type == 'course')
				{
					// Очищаем подставленный ранее адрес страницы для урока.
					History.back();
				}
			}
		}).open();

		// Сохранение данных.
		var data_id = 0;

		if (type == 'user') data_id = data.user.id;
		else if (type == 'tech') data_id = data.tech.id;
		else if (type == 'course') data_id = data.course.id;

		// Запоминаем полученные через AJAX данные, чтобы в
		// следующий раз взять их напрямую.
		storage[type][data_id] = data;

		// Создаём запись в истории открытия модальных окон.
		history.push({
			modal_type: type,
			document_id: data_id
		});
	};

	// Открытие нового модального окна.
	$(document).on('click', '.popup-initiator', function(e) {
		e.preventDefault();

		var type = $(this).data('modalType'),
			id = 0;

		if (type == 'user') id = $(this).data('userId');
		else if (type == 'course') id = $(this).data('courseId');
		else if (type == 'tech') id = $(this).data('techId');

		openModal(type, id);
	});

	// Стилизация выпадающего списка с помощью плагина jQueryFormStyler.
	var getUsersFeedback = function(callback)
	{
		var status = 400,
			users = [];

		// Запрос данных через AJAX.
		$.ajax({
			url: '/Ajax/getUsersFeedback',
			success: function(json) {
				// Код ответа.
				if (typeof json.status !== 'undefined' && json.status == 200) {
					users = json.users;
				}
			},
			complete: function() {
				callback(users);
			}
		});
	};

	// Обработчик формы обратной связи.
	var feedbackUsers = function(users)
	{
		// Добавляем первой техническую поддержку.
		users.unshift({
			id: 0,
			name: 'Техническая поддержка',
			email: 'support@site45min.ru',
			avatar: '/upload/users/support.png'
		});

		// Информация о получателе в выпадающем списке.
		var selectStylerUser = function(user)
		{
			// Шаблон.
			var template = $('#template-select-option').html();

			// Рендеринг.
			Mustache.parse(template);
			var result = Mustache.render(template, user);
			
			return $(result);
		};

		// Работа выпадающего списка.
		$('select').styler({
			selectSmartPositioning: false,
			selectPlaceholder: 'Выберите получателя',
			idSuffix: '',
			singleSelectzIndex: 1,
			onSelectOpened: function() {
				$this = $(this);

				// Добавление скроллбара.
				$this.find('.jq-selectbox__dropdown ul').perfectScrollbar({
					suppressScrollX: true
				}).perfectScrollbar('update');

				// Проходим по каждому пользователю для последующей стилизации.
				users.map(function(user) {
					// Ищем пользователя в списке и подставляем всю необходимую информацию.
					$this.find('li#select-user-' + user.id).html(selectStylerUser(user));
				});
			}
		});

		// Изменение значения выпадающего списка.
		$('select').on('change', function() {
			var $this = $(this);

			users.map(function(user) {
				// Ищем пользователя в списке и подставляем всю необходимую информацию.
				if (user.id == $this.val())
				{
					setTimeout(function() {
						$this.next('.jq-selectbox__select').find('.jq-selectbox__select-text').html(selectStylerUser(user));
					}, 10);
				}
			});
		});
	};

	// Загрузка данных перед открытием модального окна.
	var getModalData = function(id, type, callback, link)
	{
		var notify,
			status = 400,
			result = {};

		notifySettings.type = '';
		notifySettings.text = '';

		// Поиск ранее сохранённых данных.
		if (typeof storage[type][id] !== 'undefined')
		{
			return callback(type, storage[type][id]);
		}

		// Запрос данных через AJAX.
		$.ajax({
			url: '/Ajax/' + link,
			data: {
				document_id: id
			},
			beforeSend: function() {
				// Запускаем показ загрузки.
				showLoader();
			},
			success: function(json) {
				// Код ответа.
				if (typeof json.status !== 'undefined')
				{
					status = json.status;
				}

				// Запрос успешно совершён.
				if (status == 200)
				{
					result = json;
				}
				else
				{
					notifySettings.type = 'error';

					if (type == 'user') notifySettings.text = 'Пользователь не найден!';
					else if (type == 'tech') notifySettings.text = 'Информация о технологии не найдена!';
					else if (type == 'course') notifySettings.text = 'Урок не найден!';
				}
			},
			complete: function() {
				// Запускаем показ загрузки.
				hideLoader();

				if (typeof notifySettings.text !== 'undefined' && notifySettings.text != '')
				{
					notify = noty(notifySettings);
				}

				// Callback-функция для запуска рендеринга модального окна.
				callback(type, result);
			}
		});
	};

	// Вывод ошибок/уведомление при отправке сообщения через форму обратной связи.
	var completeFeedback = function(data) {
		// Удаляём все старые сообщения.
		$('form#feedback').find('.list-group-item').remove();

		if (data.status == 200)
		{
			$('form#feedback').prepend($('<div class="list-group-item list-group-item-success">Ваше сообщение успешно отправлено!</div>'));
			$('form#feedback')[0].reset();
		}
		else if (data.status == 400)
		{
			for (var key in data.errors) {
				$('form#feedback').find('label[for="form-' + key + '"]').after($('<div class="list-group-item list-group-item-danger">' + data.errors[key] + '</div>'));
			}
		}
	};

	// Обработка формы обратной связи при нажатии на кнопку "Отправить".
	$('form#feedback').on('submit', function(event) {
		event.preventDefault();

		var form = $('form#feedback').serialize();

		var notify,
			result = {};

		notifySettings.type = '';
		notifySettings.text = '';

		// Отправка сообщения на сервер для последующей обработки.
		$.ajax({
			url: '/Ajax/sendFeedbackMessage',
			data: form,
			beforeSend: function() {
				// Запускаем показ загрузки.
				showLoader();
			},
			success: function(json) {
				if (typeof json.status === 'undefined') {
					return;
				}
				
				result = json;

				if (result.status == 200) {
					notifySettings.type = 'success';
					notifySettings.text = 'Ваше сообщение успешно отправлено!';
				} else {
					notifySettings.type = 'error';
					notifySettings.text = 'Во время отправки сообщения произошла ошибка!';
				}
			},
			complete: function() {
				// Запускаем показ загрузки.
				hideLoader();

				// Показать результат операции.
				noty(notifySettings);

				completeFeedback(result);
			}
		});
	});

	getUsersFeedback(feedbackUsers);

	// Плавное перемещение к любой части сайта. Учитывает высоту навигации.
	var scrollToSection = function(object) {
		if (object == '')
		{
			return false;
		}

		return $(object).is(function() {
			// Настройки.
			var scroll_speed = 4, // пикселей в мс
				height_window = $(window).height(),
				scroll_window = $(window).scrollTop(),
				height_menu = $('.navigation-wrapper').innerHeight();

			// Информация о месте назначения.
			var dest_position = $(this).offset().top,
				destination = dest_position - height_menu;

			// Скорость прокрутки.
			var speed = Math.floor(Math.abs(scroll_window - destination) / scroll_speed);

			// Инициализация скроллинга.
			$('html, body').animate({
				scrollTop: destination
			}, speed);

			return true;
		});
	};

	// Вешаем обработчик скролла на класс ".scroll-to".
	// Элемент должен иметь атрибут: data-scroll-to="#ElementID".
	$('.scroll-to').on('click', function(e) {
		var element = $(this).data('scrollTo');

		$(element).is(function() {
			e.preventDefault();
			scrollToSection(element);

			return true;
		});
	});

	// Появление и скрытие кнопки прокрутки наверх.
	$('.scroll-to-top').is(function() {
		var $button = $(this);

		$(window).on('load scroll', function() {
			var $header = $('#site-header'),
				$menu = $('.navigation-wrapper');

			var offset_global = $(this).scrollTop();
			var offset = $header.offset().top + $header.innerHeight() - $menu.innerHeight();

			if (offset_global >= offset && !$button.hasClass('active'))
			{
				$button.addClass('active');
			}
			else if (offset_global < offset && $button.hasClass('active'))
			{
				$button.removeClass('active');
			}
		});

		return true;
	});

	// Переход к форме обратной связи при нажатии на кнопку "Отправить сообщение" 
	// в модальном окне с информацией о пользователе.
	$(document).on('click', '.send-message', function(e) {
		e.preventDefault();

		// Закрываем модальное окно.
		$(this).parents('.popup').modal().close();

		// Чистим историю, чтобы при следующем использовании модальных окон
		// не столкнуться с проблемой, когда при закрытии появляются окна.
		history = [];

		// Прокручиваем страницу до формы обратной связи.
		scrollToSection('#section-feedback-form');

		// Деактивируем выбранный ранее пункт.
		$('select option').each(function() {
			this.selected = false;
		});

		// Активируем выбранный пункт.
		$('select option[value="' + $(this).data('userId') + '"]').each(function() {
			this.selected = true;
		});

		// Обновляем состояние select.
		$('select').trigger('refresh').trigger('change');
	});

	// Менеджер для работы с фильтрами.
	var fm = $('#modal-filter').filterManager([]);

	// Переход к списку уроков из модального окна с технологией.
	$(document).on('click', '.find-courses', function(e) {
		e.preventDefault();

		var tech_id = $(this).data('techId'),
			tech_code = $(this).data('techCode');

		// Закрываем модальное окно.
		$(this).parents('.popup').modal().close();

		// Чистим историю.
		history = [];

		// Прокручиваем страницу до списка уроков.
		scrollToSection('#section-courses-list');

		// Производим переинициализацию фильтрации уроков.
		fm.filterManager([tech_code]);
	});

	// Обработка урока, размещённого на отдельной странице.
	if (typeof courseData !== 'undefined')
	{
		main_page = false;

		// Yandex.Share.
		getYandexShare(courseData);

		// Рейтинг.
		$('.course-page').Rating(courseData.id, courseData.rating, storage);
	}

	// Раскрытие/скрытие длинных списков (пользователей, технологий) при загрузке страницы.
	$(window).on('load', function() {
		$('.button-expand-list').is(function() {
			var expander = $(this).data('expandList');

			var check = $(expander).is(function() {
				if ($(this).css('display') == 'none') return true;
				return false;
			});

			if (!check) $(this).fadeOut();
		});
	});

	// Раскрытие/скрытие длинных списков (пользователей, технологий) по нажатию на кнопку.
	$(document).on('click', '.button-expand-list', function(event) {
		event.preventDefault();

		var $button = $(this);
		var expander = $button.data('expandList');
		var type = $button.data('expandType');

		$(expander).is(function() {
			if (type == 'open') // Раскрытие списка.
			{
				$(this).each(function(index, element) {
					$(this).addClass('expand-open');
				});

				$button.data('expandType', 'close').text('Скрыть');
			}
			else if (type == 'close') // Закрытие списка.
			{
				$(this).each(function(index, element) {
					$(this).removeClass('expand-open');
				});

				$button.data('expandType', 'open').text('Показать ещё');
			}

			return true;
		});
	});
});