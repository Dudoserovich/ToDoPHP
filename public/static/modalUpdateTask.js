let modalAddTask = document.getElementById('modalAddTask')

modalAddTask.addEventListener('show.bs.modal', function (event) {
    // Кнопка триггер
    let button = event.relatedTarget

    // Предзаписанные параметры
    let task = button.getAttribute('data-bs-task')
    let deadline = button.getAttribute('data-bs-deadline')
    let id = button.getAttribute('data-bs-id')

    // Обновление данных в модальном окне
    let modalTitle = modalAddTask.querySelector('.modal-title')
    let modalTask = modalAddTask.querySelector('.modal-body .task')
    let modalDateTime = modalAddTask.querySelector('.modal-body .datetime')
    let modalId = modalAddTask.querySelector('.modal-body .id')

    let cutTaskText = (task.length > 15 ? task.slice(0, 15) + '...' : task)
    modalTitle.textContent = 'Редактирование задачи "' + cutTaskText + '"'
    modalTask.value = task
    modalDateTime.value = deadline.replace(' ', 'T')
    modalId.value = id
})