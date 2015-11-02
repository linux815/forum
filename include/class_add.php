<?php
include_once('include/class_base.php');
include_once('include/class_database.php');

class C_Add extends C_Base
{
	private $titl;  // заголовок
	private $text;	// текст
	private $error;	// сообщение об ошибке

	//
	// Конструктор.
	//
	function __construct()
	{		
	}
	
	//
	// Виртуальный обработчик запроса.
	//
	protected function OnInput()
	{
		parent::OnInput();
		
		$database = new Database();
		
		// Менеджеры.
		$mUsers = M_Users::Instance();
		
		// Очистка старых сессий.
		$mUsers->ClearSessions();
		
		// Текущий пользователь.
		$this->user = $mUsers->Get();		
		
		$this->title = $this->title . ' :: Добавление форума';
		
		if ($this->IsPost())
		{
			$forum_name = $_POST['forum_name'];
			$description = $_POST['description'];
			
			if (isset($_GET['id']))
				$parent_id = $_GET['id'];
			else $parent_id=0;
			
			// удачная отправка формы
			$database->forum_insert($parent_id, $forum_name, $this->user['id_user'], $this->user['name'], $description);
			
			if (!isset($_GET['id']))
				header('Location: index.php');
			else 
				header('Location: index.php?c=showforum&id='.$_GET['id'].'&page=1');
			die();	
		}
		else
		{		

		}
	}
	
	//
	// Виртуальный генератор HTML.
	//	
	protected function OnOutput()
	{
		$vars = array('id_article' => $this->id_article, 'text' => $this->text, 'error' => $this->error, 'titl' => $this->titl);	
		$this->content = $this->Template('templates/v_add.php', $vars);
		parent::OnOutput();
	}		
}