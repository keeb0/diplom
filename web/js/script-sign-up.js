function User()
{	
	this.messege = {
			'login' : 0,
			'email' : 0,
			'pswd' : 0,
		}
	User.prototype.validateUser = function(form)
	{
		this.login = form.login.value
		this.email = form.email.value
		this.pswd = form.pswd.value
		this.pswd_conf = form.pswd_conf.value

		

		this.messege.login = this.validateLogin()
		this.messege.email = this.validateEmail()
		this.messege.pswd = this.validatePswd()

		alert(this.messege.login, this.messege.pswd)
		return true
	}

	User.prototype.validateLogin = function()
	{
		if(this.login == '')
			return 'Заполните поле логин'
		else if(/\W/.test(this.login))
			return 'В логине разрешено использовать буквы, цифры и _'
		return ''
	}

	User.prototype.validateEmail = function()
	{
		if(this.email == '')
			return 'Заполните поле e-mail'
		else if(!(this.email.indexOf('@') > 0 &&
			this.email.indexOf('.') > 0) ||
			/[^a-zA-Z0-9.@_-]/.test(this.email))
			return 'Указана некорректная электронная почта'
		return ''
	}

	User.prototype.validatePswd = function()
	{
		if(this.pswd == '')
			return 'Заполните поле пароль'
		else if(this.pswd < 6)
			return 'Пароль должен содержать не менее 6 символов'
		else if(!(/[a-z]/.test(this.pswd) &&
			/[0-9]/.test(this.pswd) &&
			/[A-Z]/.test(this.pswd)))
			return 'Пароль должен содержать хотя бы по 1 символу: a-z, A-Z, 0-9'
		else if(this.pswd != this.pswd_conf)
			return 'Пароли не совпадают'
		return ''
	}
}

user = new User