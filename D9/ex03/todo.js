$(document).ready(function() {
	$.ajax ({
		url: 'select.php',
		success: function (response) {
			var tab = JSON.parse(response);
			if (Array.isArray(tab) && tab[0] != null) {
				for (var i = 0; i < tab.length; i++) {
					if (tab[i] != null) {
						buf = tab[i].split(';');
						create_todo(buf[1]);
					}
				}
			}
		}
	});
})

function create_todo(todo_name) {
	if (todo_name != null) {
		$('#ft_list').prepend($('<div>' + todo_name + '</div>').click(remove_todo));
	}
}

function add_todo() {
	var todo_name = prompt("Please enter what TO DO: ");
	todo_name = todo_name.replace('/=/g', '');
	todo_name = todo_name.replace('/;/g', '');
	if (todo_name != null && todo_name.length > 0) {
		create_todo(todo_name);
		$.ajax ({
			type: "GET",
			url: "insert.php?" + todo_name + "=" + todo_name
		});
	}
}

function remove_todo() {
	if (confirm("Remove the TODO?")) {
		this.remove();
		remove_data(this.innerHTML);
	}
}

function remove_data(todo_name) {
	$.ajax({
		type: "GET",
		url: "delete.php?" + todo_name + "=" + todo_name,
		success: function () {}
	});
}
