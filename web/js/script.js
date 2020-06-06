var input_form = document.getElementsByTagName('input');

var test = {
	login: input_form.login.value,
	email: input_form.email.value,
	// firstName: input_form.firstName.value,
	// surname: input_form.surname.value,
	// patronymic: input_form.patronymic.value
}
console.log(input_form.login_user)

function hide(id_hide, id, cancel_id = null, input_id2= 1, input_id3= null)
{
	var detected = document.getElementById(id),
		hiding = document.getElementById(id_hide);

	hiding.setAttribute('hidden', 'hidden');
	detected.removeAttribute('hidden');

	if(cancel_id != '')
	{
		var input = document.getElementById(cancel_id);

		switch (cancel_id) {
			case 'login_user':
				input.value = test.login;
				break;
			case 'email_user':
				input.value = test.email;
				break;
			case 'pswdOld_user':
				input.value = '';
				break;
		}
	}
	if(input_id2 != '')
	{
		var input2 = document.getElementById(input_id2),
			input3 = document.getElementById(input_id3);

		input2.value = '';
		input3.value = '';
	}
}