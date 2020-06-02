departments_amount = document.getElementById('departmentsId').getElementsByTagName('id').length
departments = new Array()
all_departments = document.getElementById('departmentsId')

for (i = 0; i < departments_amount; i++) {
	departments.push({
		'id': all_departments.getElementsByTagName('id')[i].innerHTML,
		'name': all_departments.getElementsByTagName('name')[i].innerHTML,
		'facultyId': all_departments.getElementsByTagName('facultyId')[i].innerHTML
		})

}
// console.log(departments[2].id)

function test()
{
	departmentObj = document.getElementById('departmentId')
	facultyIndex = document.getElementById('facultyId').options.selectedIndex - 1
	// console.log(facultyId)

	departmentObj.length = 0

	if (facultyIndex != 0) {
		// departmentObj.hidden = 'false'
		if (facultyIndex == -1)
			departmentObj[0] = new Option('Выберите факультет', -1)
		
		departmentObj[0] = new Option('пусто', -1)
		departmentObj[1] = new Option('для всего факультета', 0)
		
		for (i = 0, j = 2; i < departments_amount; i++) {
			if (facultyIndex == departments[i].facultyId) {
				departmentObj[j] = new Option(departments[i].name, departments[i].id)
				j++
			}
		}
	}
}