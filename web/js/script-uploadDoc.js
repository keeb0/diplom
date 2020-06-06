subjects_amount = document.getElementById('subjects_data').getElementsByTagName('id').length
subjects = new Array()
all_subjects = document.getElementById('subjects_data')

for (i = 0; i < subjects_amount; i++) {
	subjects.push({
		'id': all_subjects.getElementsByTagName('id')[i].innerHTML,
		'name': all_subjects.getElementsByTagName('name')[i].innerHTML,
		})
}

subjects_option = document.getElementById('subjects_option')

subjects_option[0] = new Option('пусто', -1)

for (i = 0; i < subjects_amount; i++) {
	subjects_option[i+1] = new Option(subjects[i].name, subjects[i].id)
}