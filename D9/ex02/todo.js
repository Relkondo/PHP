
function add_todo() {
	var todo_name = prompt("Enter your new todo: ");
	todo_name = todo_name.replace('/=/g', '');
	todo_name = todo_name.replace('/;/g', '');
	if (todo_name !== null && todo_name.length > 0){
		create_todo(todo_name);
	}
}

function create_todo(todo_name)
{
	var div = document.createElement('div');
	var textnd = document.createTextNode(todo_name);
	div.appendChild(textnd);
	var todolist = document.getElementById('ft_list');
	div.addEventListener("click", remove_todo);
	div.addEventListener("click", function() {
		document.cookie = todo_name + '=; expires=Tue, 15 Sep 1992 00:00:00 GMT;';
	});
	todolist.insertBefore(div, todolist.childNodes[0]);
	document.cookie = todo_name+ "=" + todo_name+ ";";
}

function remove_todo() {
	if (confirm("Remove the todo ?")) {
		this.parentNode.removeChild(this);
	}
}

function cookies_refresh() {
	var tab = document.cookie.split(';');
	if (Array.isArray(tab) && tab[0] != null) {
		for (var i = 0; i < tab.length; i++) {
			todo = tab[i].split('=');
			if (todo[1] != null)
			create_todo(todo[1]);
		}
	}
}
