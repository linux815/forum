<?php
include_once('include/class_base.php');
include_once('include/class_database.php');
include_once('include/class_user.php');

//
// Контроллер страницы редактирования.
//
class C_Register extends C_Base
{
	private $titl;  // заголовок
	private $text;	// текст
	private $error;	// сообщение об ошибке

	//
	// Конструктор.
	//
	function __construct()
	{
		session_start();
	}

	//
	// Виртуальный обработчик запроса.
	//
	protected function OnInput()
	{
		parent::OnInput();

		$database = new Database();

		$this->title = $this->title . ' :: Регистрация';

		// Менеджеры.
		$mUsers = M_Users::Instance();

		// Очистка старых сессий.
		$mUsers->ClearSessions();

		if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

		// Тут, товарисчи, вы можете делать что хотите. Данные из формы приходят методом POST,
		// т.е. имеют вид $_POST["varible"]
		$login = $mUsers->GetLogin($_POST['name_post']);
		if ($login[0] <> 0)
		{
			$txt = "Такой email уже существует! Введите другой.";
			echo $txt;
			die();
		}

		if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['name_post']))) {
		$txt = "<p class='otvet'>Email введен не правильно! Повторите попытку..</p>";
		echo $txt;
		die();
		}

		if ( $_POST['fam'] == "")
		{
			$txt = "Введите отображаемое имя";
			echo $txt;
			die();
		}
		else echo "";

		if(empty($_POST['name_post']) || empty($_POST['fam']) || empty($_POST['pass']) || empty($_POST['repass']))
		{
			$txt = "Ошибка. Заполните все поля в \"Персональных данных\"";
			echo $txt;
			die();
		}

		if($_POST['pass'] <> $_POST['repass'])
		{
			$txt = "Ошибка. Пароли не совпадают!";
			echo $txt;
			die();
		}


		$a = $_POST['name_post'];
		$b = $_POST['pass'];
		$c = $_POST['fam'];
		$d = md5($_POST['pass']);

		$mUsers->user_insert($a, $d, $c);

		$txt = "<p class='otvet'>Регистрация успешно завершена!<br />
		Email: ".$a."<br />
		Пароль: ".$b."<br />
		Запомните ваш логин и пароль.<br />
		<a href=index.php?c=auth> Войти</a>
		</p>

		";
		echo $txt;
		die();
		}
	}

	//
	// Виртуальный генератор HTML.
	//
	protected function OnOutput()
	{
		$vars = array('id_article' => $this->id_article, 'text' => $this->text, 'error' => $this->error, 'titl' => $this->titl);
		$this->content = $this->Template('templates/v_register.php', $vars);
		parent::OnOutput();
	}
}