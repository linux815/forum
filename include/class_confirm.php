<?php
include_once('include/class_base.php');
include_once('include/class_database.php');

class C_Confirm extends C_Base
{
	private $titl;  // заголовок
	private $text;	// текст
	private $error;	// сообщение об ошибке
	private $char;

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
		
		$this->title = $this->title . ' :: Удаление';
		
		$id_forum = $_GET['forum'];
		$id_thread = $_GET['thread'];
		$id_message = $_GET['delete'];
		$id_forums = $_GET['id'];
		$id_post = $_GET['post'];
		
		if (isset($_GET['forum'])) 
		{
			$this->char = "Вы действительно хотите удалить данный раздел?";
		}
		
		if (isset($_GET['thread']))
		{
			$this->char = "Вы действительно хотите удалить данную тему?";
		}
		
		if (isset($_GET['post']))
		{
			$this->char = "Вы действительно хотите удалить данное сообщение?";
		}
		
		
		if ($_POST['Yes'])
		{
			if (isset($_GET['forum']))
				header('Location: index.php?c=delete&id='.$id_forums.'&forum='.$id_forum);	
			
			if (isset($_GET['thread']))
				header('Location: index.php?c=delete&id='.$id_forums.'&thread='.$id_thread);
				
			if (isset($_GET['post']))
				header('Location: index.php?c=delete&forums='.$_GET['forums'].'&post='.$_GET['post'].'&threads='.$_GET['threads']);		
		} 
		else 
		{
			if ($_POST['No'])
			{
				header('Location: index.php');
			}
		}
	}
	
	//
	// Виртуальный генератор HTML.
	//	
	protected function OnOutput()
	{
		$vars = array('char' => $this->char, 'text' => $this->text, 'error' => $this->error, 'titl' => $this->titl);	
		$this->content = $this->Template('templates/v_confirm.php', $vars);
		parent::OnOutput();
	}		
}