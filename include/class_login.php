<?php
include_once('include/class_base.php');
include_once('include/class_database.php');
include_once('include/class_user.php');

//
// Контроллер страницы редактирования.
//
class C_Auth extends C_Base
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
		
		$this->title = $this->title . ' :: Авторизация';
		
		// Менеджеры.
		$mUsers = M_Users::Instance();
		
		// Очистка старых сессий.
		$mUsers->ClearSessions();
		
		// Выход.
		$mUsers->Logout();
		
		// Обработка отправки формы.
		if (!empty($_POST))
		{
			if ($mUsers->Login($_POST['login'], 
			                   $_POST['password'], 
							   isset($_POST['remember'])))
			{
				header('Location: index.php');
				die();
			}
		}
	}
	
	//
	// Виртуальный генератор HTML.
	//	
	protected function OnOutput()
	{
		$vars = array('id_article' => $this->id_article, 'text' => $this->text, 'error' => $this->error, 'titl' => $this->titl);	
		$this->content = $this->Template('templates/v_login.php', $vars);
		parent::OnOutput();
	}	
}
