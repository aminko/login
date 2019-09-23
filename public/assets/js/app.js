function Task(name, details, id) {
    this.name = name;
    this.details = details;
    this.id = id;
}

function List(datasources) {
    this.datasources = datasources;
    this.tasks = null;
}

List.prototype.fetchTasks = function () {
    if (!this.tasks) {
        const getData = () => {
            const promise = fetch(this.datasources.tasks, { credentials: 'same-origin' })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Connection error, status = ' + response.status);
                    }
                    return response.json();
                })
                .then(json => {
                    return json;
                })
                .catch(function (err) {
                    console.log(err);
                });
            return promise;
        };

        this.tasks = getData();
    }
    return this.tasks;
}

function UI() {
    this.node;
    this.list;
    this.tasks = [];
}

UI.prototype.init = function (node, form, wrapper, datasources) {
    this.node = node;
    this.form = form;
    this.wrapper = wrapper;
    this.tasks = null;
    this.list = new List(datasources);
    
    this.list.fetchTasks()
    .then((tasks) => {
        this.tasks = tasks;
        this.displayTasks();

        this.list.tasks = tasks;  // TODO: ...
    })
    .catch(err => console.log(err));

    form.addEventListener('submit', this);
    node.addEventListener('click', this);
}

UI.prototype.handleEvent = function (e) {
    e.preventDefault();
    if (e.type === 'submit' && e.target == this.form) {
        this.addTask();
    }
    if (e.type === 'click' && this.node.contains(e.target)) {
        // delete task if user clicks on delete button
        if (e.target.nodeName.toLowerCase() === 'a' && e.target.classList.contains('delete')) {
            this.removeTask(e.target.closest('tr'), e.target.dataset.id);
        }
    }
}

UI.prototype.displayTasks = function () {
    let taskList = '';

    this.tasks.forEach(function (task) {
        let template =
            `<tr>
            <td>${task.id}</td>
            <td>${task.name}</td>
            <td>${task.details}</td>
            <td><a href="#" class="task-item delete" data-id="${task.id}">Delete</a></td>
        </tr>`;
        taskList += template;
    });
    this.node.innerHTML = taskList;

}
UI.prototype.showMessage = function (message, type) {

    let messageDiv = document.createElement('div');
    const parentDiv = this.wrapper.parentNode;

    if (type === 'error') {
        messageDiv.className = 'error';
    } else if (type === 'success') {
        messageDiv.className = 'success';
    }
    messageDiv.appendChild(document.createTextNode(message));
    let insertedMessage = parentDiv.insertBefore(messageDiv, this.wrapper);
    // remove message after 3 seconds
    setTimeout(() => insertedMessage.remove(), 3000);
}

UI.prototype.addTask = function () {
    let name = document.querySelector('#task-name'),
        details = document.querySelector('#task-description');
        //id = document.querySelector('#task-id');

    if (!name.value || !details.value) {
        this.showMessage('Name and description should be filled out', 'error');
    } else {
        let data = new FormData(this.form);

        fetch(this.list.datasources.addTask, { 
            credentials: 'same-origin',
            method: 'POST',
            body: data
         })
        .then(response => {
            if (!response.ok) {
                throw new Error('Connection error, status = ' + response.status);
            }
            return response.json();
        }).then(response => {
            if(response.response === true) {
                const task = new Task(name.value, details.value, response.message);
            
                this.list.addTask(task);
    
                const taskTemplate = `<tr>
                    <td>${task.id}</td>
                    <td>${task.name}</td>
                    <td>${task.details}</td>
                    <td><a href="#" class="task-item delete" data-id="${task.id}">Delete</a></td>
                </tr>`;
                this.node.insertAdjacentHTML('beforeend', taskTemplate);
                this.showMessage('New task added', 'success');
                name.value = '';
                details.value = '';

            } else {
                throw new Error('Server error: ' + response.message);
            }
        });
    }
}

UI.prototype.removeTask = function (targetNode, id) {
   
    // ugly. I know
    fetch(this.list.datasources.root + `/task/${id}/delete`, { 
        credentials: 'same-origin',
        method: 'POST',
        body: {}
     })
    .then(response => {
        if (!response.ok) {
            throw new Error('Connection error, status = ' + response.status);
        }
        return response.json();
    }).then(response => {
        if(response.response === true) {
            //remove task from UI
            targetNode.remove();
            // remove from localStorage
            this.list.removeTask(id);
            // display message
            this.showMessage('Task was removed', 'success');
        } else {
            throw new Error('Server error: ' + response.message);
        }
    });
}
    


List.prototype.addTask = function (task) {
    this.tasks.push(task);
}


List.prototype.getTasks = function () { return this.tasks; };

List.prototype.removeTask = function (id) {
    let b = this.tasks;
    let index = b.indexOf(b.find(task => task.id === id));

    // check if task with provided id exists in the list
    if (index != -1) {
        // if task exists then remove it form list
        b.splice(index, 1)
    } else {
        return false;
    }
    return true;
}


