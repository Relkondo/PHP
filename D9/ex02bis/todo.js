$(document).ready(function() {
	var tab = document.cookie.split(';');
	if (Array.isArray(tab) && tab[0] != null) {
		for (var i = 0; i < tab.length; i++) {
			todo = tab[i].split('=');
			if (todo[1] !== null)
				create_todo(todo[1]);
		}
	}
})

function add_todo() {
	var todo_name = prompt("Enter your new todo: ");
	todo_name = todo_name.replace('/=/g', '');
	todo_name = todo_name.replace('/;/g', '');
	if (todo_name !== null && todo_name.length > 0){
		create_todo(todo_name);
	}
}

function remove_todo() {
	if (confirm("Remove the todo ?")) {
		this.remove();
		document.cookie = this.innerHTML + '=; expires=Thu, 15 Sep 1992 00:00:00 GMT;';
	}
}

function create_todo(todo_name) {
	$('#ft_list').prepend($('<div>' + todo_name + '</div>').click(remove_todo));
	document.cookie = todo_name + "=" + todo_name + ";";
}
