﻿<?phpinclude_once('include/Controller/Controller.php');include_once('include/class_user.php');//// Базовый контроллер сайта.//abstract class C_Base extends Controller{	protected $title;		// заголовок страницы	protected $content;		// содержание страницы	protected $id_article;	protected $id_forums;	protected $id_posts;	protected $msg_count;	private $check;	//	// Конструктор.	//	function __construct()	{		session_start();			}		//	// Виртуальный обработчик запроса.	//	protected function OnInput()	{		$this->title = 'Форум';		$this->id_article = 'null';		$this->id_forums = 'null';		$this->id_threads = 'null';		$this->id_posts = 'null';		$this->content = '';				$mUsers = M_Users::Instance();				// Очистка старых сессий.		$mUsers->ClearSessions();				// Текущий пользователь.		$this->user = $mUsers->Get();				// Количество сообщений	    $this->check = $mUsers->message_count()->fetch(); 			    if ($this->check['count'] == 0)	    	$this->msg_count = "";	    else 			$this->msg_count = "(".$this->check['count'].")";	}		//	// Виртуальный генератор HTML.	//		protected function OnOutput()	{		$vars = array('title' => $this->title, 'content' => $this->content, 'id_article' => $this->id_article, 'msg_count' => $this->msg_count, 'id_forums' => $this->id_forums, 'id_thread' => $this->id_threads, 'id_posts' => $this->id_posts, 'user' => $this->user);			$page = $this->Template('templates/v_main.php', $vars);						echo $page;	}	}