console.log('WORKING!')

// - Функция -  Раскрывающий список
function hundleSelect(boxesSelect, boxSelect) {
	try {
		const nameItems = document.querySelectorAll(boxesSelect),
			body = document.querySelector('body')

		nameItems.forEach(item => {
			const select = item,
				selectItem = item.querySelector(boxSelect)

			//	Функционал раскрытия/сворачивания выпадающих списокв
			selectItem.addEventListener('click', e => {
				if (!select.classList.contains('open')) {
					nameItems.forEach(box => {
						box.classList.remove('open')
						box.querySelector(boxSelect).classList.remove('open')
					})
					select.classList.add('open')
					selectItem.classList.add('open')
				} else {
					select.classList.remove('open')
					selectItem.classList.remove('open')
				}
			})

			// Отслеживаем клик по элементам
			select.addEventListener('click', e => {
				const target = e.target
				if (
					target &&
					target.tagName === 'A' &&
					!target.classList.contains('active')
				) {
					const value = target.innerText
					try {
						select.querySelector('a.active').classList.remove('active')
					} catch (e) {}
					target.classList.add('active')
					selectItem.innerText = value
					select.classList.remove('open')
					selectItem.classList.remove('open')
				}
			})

			// Сворачиваем список при клики вне элемента
			body.addEventListener('click', e => {
				const target = e.target
				const targetBody = e.currentTarget
				if (target !== selectItem && targetBody === body) {
					target.classList.add('active')
					select.classList.remove('open')
					selectItem.classList.remove('open')
				} else {
				}
			})
		})
	} catch (err) {
		console.log(err)
	}
}
hundleSelect('.panel__box', '.panel__value')

function formatTime() {
	try {
		const workTimes = document.querySelectorAll('[work-time]')

		workTimes.forEach(time => {
			time.textContent = time.textContent.slice(0, 5)
		})
	} catch {
		return
	}
}
formatTime()

function someFun() {
	try {
		const btn = document.querySelector('#send')
		const btn_2 = document.querySelector('#login')
		const btn_3 = document.querySelector('#label')
		const btn_4 = document.querySelector('#label_1')

		btn.addEventListener('click', e => {
			e.target.style.display = 'none'
			btn_2.style.display = 'block'
			btn_3.style.display = 'block'
			btn_4.style.display = 'none'
		})
	} catch (e) {
		return
	}
}

someFun()

const modalPages = (open, modalContent) => {
	try {
		const btns = document.querySelectorAll(open),
			modal = document.querySelector(modalContent),
			close = modal.querySelector('[data-close]')

		btns.forEach(btn => {
			btn.addEventListener('click', e => {
				e.preventDefault()
				modal.classList.add('_active')
			})
		})

		close.addEventListener('click', e => {
			modal.classList.remove('_active')
		})

		modal.addEventListener('click', e => {
			if (e.target && e.target === modal) {
				modal.classList.remove('_active')
			}
		})
	} catch (err) {
		return
	}
}
modalPages('#btn-add-schedule-employee', '#modal-add-schedule-employee')
modalPages('#btn-add-employee', '#modal-add-employee')
modalPages('#btn-add-schedule', '#modal-add-schedule')
modalPages('#btn-edit-employee', '#modal-edit-employee')
modalPages('#btn-edit-client', '#modal-edit-client')
modalPages('#btn-add-client', '#modal-add-client')
modalPages('#btn-add-service', '#modal-add-service')
modalPages('#btn-edit-service', '#modal-edit-service')
modalPages('.panel__ser-emp-add', '#modal-emp-to-service')

function formErrorModal(modalItem, formError) {
	try {
		const modal = document.getElementById(modalItem)
		if (document.getElementById(formError) !== null) {
			modal.classList.add('_active')
		}
	} catch (e) {
		console.log(e)
	}
}
formErrorModal('modal-add-employee', 'formError')
formErrorModal('modal-edit-employee', 'formErrorEditEmployee')
formErrorModal('modal-edit-client', 'formErrorEditClient')
formErrorModal('modal-add-client', 'formErrorAddClient')
formErrorModal('modal-add-service', 'formErrorAddService')
formErrorModal('modal-edit-service', 'formErrorEditService')
formErrorModal('modal-add-schedule', 'formErrorAddSchedule')

const getInfoEmployee = (items, type) => {
	try {
		try {
			var editButtons = document.querySelectorAll(items)
		} catch {
			return
		}

		if (editButtons) {
			editButtons.forEach(function (button) {
				button.addEventListener('click', function (event) {
					event.preventDefault()

					if (type === 'edit_service') {
						var id = this.getAttribute('data-id')
						var duration = this.getAttribute('data-duration')
						var price = this.getAttribute('data-price')

						document.querySelector(
							'#modal-edit-service input[name="id_service"]'
						).value = id
						document.querySelector(
							'#modal-edit-service input[name="duration_service"]'
						).value = duration
						document.querySelector(
							'#modal-edit-service input[name="price_service"]'
						).value = price
					}

					if (type === 'edit_client') {
						var id = this.getAttribute('data-id')
						var name = this.getAttribute('data-name')
						var email = this.getAttribute('data-email')
						var phone = this.getAttribute('data-phone')

						document.querySelector(
							'#modal-edit-client input[name="id_client"]'
						).value = id
						document.querySelector(
							'#modal-edit-client input[name="name_client"]'
						).value = name
						document.querySelector(
							'#modal-edit-client input[name="email_client"]'
						).value = email
						document.querySelector(
							'#modal-edit-client input[name="phone_client"]'
						).value = phone
					}

					if (type === 'edit_employee') {
						var id = this.getAttribute('data-id')
						var name = this.getAttribute('data-name')
						// var position = this.getAttribute('data-position')
						var email = this.getAttribute('data-email')
						var phone = this.getAttribute('data-phone')
						var description = this.getAttribute('data-description')

						document.querySelector(
							'#modal-edit-employee input[name="id_employee"]'
						).value = id
						document.querySelector(
							'#modal-edit-employee input[name="name_employee"]'
						).value = name
						// document.querySelector(
						// 	'#modal-edit-employee select[name="position_employee"]'
						// ).value = position
						document.querySelector(
							'#modal-edit-employee input[name="email_employee"]'
						).value = email
						document.querySelector(
							'#modal-edit-employee input[name="phone_employee"]'
						).value = phone
						document.querySelector(
							'#modal-edit-employee textarea[name="description_employee"]'
						).value = description
					}

					if (type === 'add_emp_to_service') {
						var id = this.getAttribute('data-id')

						document.querySelector(
							'#modal-emp-to-service input[name="id_service"]'
						).value = id
					}
				})
			})
		}
	} catch {
		return
	}
}

getInfoEmployee('.edit-btn', 'edit_employee')
getInfoEmployee('.edit-btn', 'edit_client')
getInfoEmployee('.edit-btn', 'edit_service')
getInfoEmployee('.add-btn', 'add_emp_to_service')

const accordeon = (btns, items) => {
	try {
		const openBtns = document.querySelectorAll(btns)
		const itemsHide = document.querySelectorAll(items)

		openBtns.forEach((btn, i) => {
			btn.addEventListener('click', e => {
				e.preventDefault()
				btn.parentElement.classList.toggle('i-active')
				itemsHide[i].classList.toggle('i-active')
			})
		})
	} catch (e) {
		console.log(e)
	}
}
accordeon('.panel__empls', '.panel__body .panel__list')
accordeon('.panel__recds', '.panel__body .panel__list-recording')

const accordeon_2 = (btns, items) => {
	try {
		const openBtns = document.querySelectorAll(btns)
		const itemsHide = document.querySelectorAll(items)

		openBtns.forEach((btn, i) => {
			btn.addEventListener('click', e => {
				e.preventDefault()
				btn.classList.toggle('i-active')
				itemsHide[i].classList.toggle('i-active')
			})
		})
	} catch (e) {
		console.log(e)
	}
}
accordeon_2('.booking__h-item', '.booking__f-item')

const choisePost = () => {
  try {
    const itemSelect = document.querySelector('select[name="position"]');
    const _choise_1 = document.querySelector('._choise_1');
    const _choise_2 = document.querySelector('._choise_2');
    const title = document.querySelector('._br_t');
    const brandSelect = document.querySelector('select[name="brend"]');

    itemSelect.addEventListener('change', function (e) {
      const positionId = e.target.value;

      if (positionId == 4) { // Администратор
        _choise_1.style.display = 'block';
        _choise_2.style.display = 'none';
        title.style.display = 'block';
      } else {
        _choise_1.style.display = 'none';
        _choise_2.style.display = 'block';
        title.style.display = 'block';

        // AJAX-запрос для получения брендов
        fetch(`get_brands_by_position.php?position_id=${positionId}`)
          .then(response => response.json())
          .then(data => {
            brandSelect.innerHTML = '<option selected disabled>Выберите наименование бренда</option>';
            data.forEach(brand => {
              const option = document.createElement('option');
              option.value = brand.id;
              option.textContent = brand.name;
              brandSelect.appendChild(option);
            });
          })
          .catch(error => console.error('Error fetching brands:', error));
      }
    });
  } catch (e) {
    return
  }
};

document.addEventListener('DOMContentLoaded', choisePost)

const componentSwiper = () => {
	try {
		const swiper = new Swiper('.swiper', {
			loop: true,
			allowTouchMove: true,
			speed: 900,
			slidesPerView: 1,
			spaceBetween: 30,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		})
	} catch (e) {
		console.log(e)
	}
}

componentSwiper()

const tabs = (headerSelector, tabSelector, contentSelector, activeClass) => {
	try {
		const header = document.querySelector(headerSelector),
			tab = document.querySelectorAll(tabSelector),
			content = document.querySelectorAll(contentSelector)

		function showTabContent(i = 0) {
			tab[i].classList.add(activeClass)
			content[i].classList.add(activeClass)
		}

		function hideTabContent() {
			tab.forEach(item => {
				item.classList.remove(activeClass)
			})
			content.forEach(item => {
				item.classList.remove(activeClass)
			})
		}

		hideTabContent()
		showTabContent()

		header.addEventListener('click', e => {
			const target = e.target
			if (
				target &&
				(target.classList.contains(tabSelector.replace(/\./, '')) ||
					target.parentNode.classList.contains(tabSelector.replace(/\./, '')))
			) {
				tab.forEach((item, i) => {
					if (target == item || target.parentNode == item) {
						hideTabContent()
						showTabContent(i)
					}
				})
			}
		})
	} catch (e) {
		return
	}
}

tabs('.personal__tabs', '.personal__tab', '.personal__wrap', 'active')
tabs('.sign-in__tabs', '.sign-in__tab', '.sign-in__wrap', 'active')

// const currentDate = document.querySelector('.panel__date span').textContent

// const nextButton = document.querySelector('.panel__next')
// // Функция для обработки нажатия на кнопку "Следующая неделя"
// nextButton.addEventListener('click', function (event) {
// 	event.preventDefault() // Предотвращаем стандартное поведение ссылки
// 	// Добавляем 7 дней к текущей дате
// 	const nextWeekDate = new Date(currentDate)
// 	console.log(nextWeekDate)
// 	nextWeekDate.setDate(nextWeekDate.getDate() + 7)

// 	// Перенаправляем на страницу с новой датой
// 	// window.location.href =
// 	// 	'page-admin.php?date=' + nextWeekDate.toISOString().slice(0, 10)
// })

// function displayDaysOfWeek() {
//     try {
//         const daysOfWeekContainer = document.getElementById('days-of-week');
//         let html = '';
//         for (let i = 0; i < 7; i++) {
//             const date = getDateForDay(i);
//             const dayName = date.toLocaleDateString('ru-RU', { weekday: 'short' });
//             const formattedDate = date.toLocaleDateString('ru-RU', { month: 'short', day: 'numeric' });
//             html += `<button onclick="selectDay('${date.toISOString().split('T')[0]}')">${dayName.toUpperCase()}, ${formattedDate}</button>`;
//         }
//         daysOfWeekContainer.innerHTML = html;
//     } catch (err) {
//         console.log(err)
//     }
// }

// displayDaysOfWeek();
