<?php
include_once('include/class_base.php');
include_once('include/class_database.php');
include_once('include/class_user.php');
//
// Контроллер удаления данных
//
class C_Delete extends C_Base
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

		if (isset($_GET['forum']))
		{
			$id_forum = $_GET['forum'];
			$database->forum_delete($id_forum);
			
			if (!isset($_GET['id']))
				header('Location: index.php');
			else 
				header('Location: index.php?c=showforum&id='.$_GET['id'].'&page=1');
			die();
		}
		
		if (isset($_GET['thread']))
		{
			$num = 1;
			$start = 0;			
			$id_forums = $_GET['id'];			
			$id_thread = $_GET['thread'];
			
			$c = $database->thread_select_count($id_thread)->fetch();
			$database->thread_delete($id_thread);
			$database->forum_update_statdel($id_forums);	
			$row = $database->thread_select($id_forums, $start, $num)->fetch();
			$database->forum_update_lastmm2($row['id_user'], $row['login'], $id_forums, $c[0]);		
			
			header('Location: index.php?c=showforum&id='.$id_forums.'&page=1');
			die();
		}

		if (isset($_GET['post']))
		{
			$id_post = $_GET['post'];
			$id_forums = $_GET['forums'];
			$id_thread = $_GET['threads'];
			
			$database->post_delete($id_post);
			$database->post_update_stat2($id_thread);
			$database->post_update_stat3($id_forums);
			
			$id_forum = $_GET['forum'];
			$num = 1;
			$start = 0;
			
			$row = $database->thread_select($id_forums, $start, $num)->fetch();
			$database->forum_update_lastm("0", "", $id_thread);
			$database->forum_update_lastm2($row['id_user'], $row['login'], $id_forums);
			
	     	header('Location: index.php?c=showmessage&forums='.$id_forums.'&id='.$id_thread.'&page=1');
			die();			
		}
	}
	
	//
	// Виртуальный генератор HTML.
	//	
	protected function OnOutput()
	{
		$vars = array('id_article' => $this->id_article, 'text' => $this->text, 'error' => $this->error, 'titl' => $this->titl);	
		$this->content = $this->Template('templates/v_view.php', $vars);
		parent::OnOutput();
	}	
}