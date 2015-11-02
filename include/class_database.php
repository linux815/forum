<?php
class Database
{
	public $hostname;
	public $username;
	public $password;
	public $dbName;

	public function __construct()
	{
		$this->hostname = "localhost";
		$this->username = "root";
		$this->password = "AiR5a299Ra";
		$this->dbName   = "forum";
	}

	public function forums_select()
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = 'SELECT * FROM forums WHERE parent_forum_id = 0';

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forums_select_podforum($id_parent)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT * FROM forums WHERE parent_forum_id = '$id_parent'";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forums_select_forum($id_forums)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT * FROM forums WHERE id_forums = '$id_forums'";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function thread_select($forum_id, $start, $num)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT * FROM forum_threads,users WHERE forum_id = $forum_id AND id_user = author_user_id ORDER BY priority ASC, date DESC, last_post DESC LIMIT $start, $num";
	//	forum_id = $forum_id AND forum_thread_id = id_thread ORDER BY post_date DESC
			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function thread_select_thread($id_threads)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT * FROM forum_threads WHERE id_thread = $id_threads";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_select($thread_id, $start, $num)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT * FROM forum_posts, forum_threads, users WHERE forum_thread_id = $thread_id AND id_thread = $thread_id AND id_user = user_id ORDER BY post_date ASC LIMIT $start, $num";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_select_last($forum_id)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT * FROM forum_posts, forum_threads, users WHERE forum_id = $forum_id ORDER BY post_date DESC, id_thread DESC ";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_count($thread_id)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT COUNT(*) FROM forum_posts WHERE forum_thread_id = $thread_id";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_select_post($id_posts)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT * FROM forum_posts WHERE id_posts = $id_posts";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function count_table($forum_id)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT COUNT(forum_id) FROM forum_threads WHERE forum_id = $forum_id";

			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_delete($id_forum)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "DELETE FROM t1, t2, t3 USING forums AS t1 LEFT JOIN forum_threads AS t2 ON t1.id_forums = t2.forum_id LEFT JOIN forum_posts AS t3 ON t2.forum_id = t3.forum_thread_id WHERE t1.id_forums = $id_forum ";
			$dbh->exec($sql);
			//return $count;

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function thread_delete($id_thread)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "DELETE FROM t1, t2 USING forum_threads AS t1 LEFT JOIN forum_posts AS t2 ON t1.id_thread = t2.forum_thread_id WHERE t1.id_thread = $id_thread ";
			$dbh->exec($sql);
			//return $count;

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function thread_select_count($id_thread)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "SELECT COUNT(forum_thread_id) FROM forum_threads,forum_posts WHERE id_thread = forum_thread_id AND id_thread = $id_thread";
			return $dbh->query($sql);

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_delete($id_post)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "DELETE FROM forum_posts WHERE id_posts = ?";
			$q = $dbh->prepare($sql);
			$q->execute(array($id_post));
			//return $count;

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update($id_forums, $forum_name, $description)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "UPDATE forums
	        SET forum_name=?, description=?
	        WHERE id_forums=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($forum_name,$description,$id_forums));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update_last($id_last_author, $last_author, $id_thread)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$last_post = date('Y-m-d H:i:s');

			$sql = "UPDATE forum_threads
	        SET posts_quantity=posts_quantity+1, id_last_author=?, last_author=?, last_post=?
	        WHERE id_thread = ?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_last_author,$last_author,$last_post,$id_thread));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update_lastm($id_last_author, $last_author, $id_thread)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$last_post = date('Y-m-d H:i:s');

			$sql = "UPDATE forum_threads
	        SET id_last_author=?, last_author=?, last_post=?
	        WHERE id_thread = ?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_last_author,$last_author,$last_post,$id_thread));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update_last2($id_last_author, $last_author, $id_forum, $id_thread)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$last_post = date('Y-m-d H:i:s');

			$sql = "UPDATE forums
	        SET posts_quantity=posts_quantity+1, id_last_author=?, last_author=?, last_post=?, id_thread_last=?
	        WHERE id_forums = ?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_last_author,$last_author,$last_post,$id_thread,$id_forum));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update_lastm2($id_last_author, $last_author, $id_forum)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$last_post = date('Y-m-d H:i:s');

			$sql = "UPDATE forums
	        SET id_last_author=?, last_author=?, last_post=?
	        WHERE id_forums = ?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_last_author,$last_author,$last_post,$id_forum));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update_lastmm2($id_last_author, $last_author, $id_forum, $c)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$last_post = date('Y-m-d H:i:s');

			$sql = "UPDATE forums
	        SET posts_quantity=posts_quantity-?, id_last_author=?, last_author=?, last_post=?
	        WHERE id_forums = ?";

			$q = $dbh->prepare($sql);
			$q->execute(array($c,$id_last_author,$last_author,$last_post,$id_forum));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_insert($parent_id, $forum_name, $id_last_author, $last_author, $description)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$last_post = date('Y-m-d H:i:s');

			$sql = "INSERT INTO forums (parent_forum_id,forum_name,id_last_author,last_author,last_post,description) VALUES (:parent_forum_id,:forum_name,:id_last_author,:last_author,:last_post,:description)";
			$q = $dbh->prepare($sql);
			$q->execute(array(':parent_forum_id'=>$parent_id,
							  ':forum_name'=>$forum_name,
						      ':id_last_author'=>$id_last_author,
							  ':last_author'=>$last_author,
							  ':last_post'=>$last_post,
		              		  ':description'=>$description));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function posts_insert($forum_thread_id, $header, $user_id, $post_text)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$post_date = date('Y-m-d H:i:s');

			$sql = "INSERT INTO forum_posts (forum_thread_id,header,post_date,user_id,post_text) VALUES (:forum_thread_id,:header,:post_date,:user_id,:post_text)";
			$q = $dbh->prepare($sql);
			$q->execute(array(':forum_thread_id'=>$forum_thread_id,
		              		  ':header'=>$header,
							  ':post_date'=>$post_date,
							  ':user_id'=>$user_id,
							  ':post_text'=>$post_text));
			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function thread_insert($forum_id, $thread_name, $description, $title, $text, $user, $id_last_author, $last_author)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$date = date('Y-m-d H:i:s');

			$sql = "INSERT INTO forum_threads (forum_id,thread_name,title,text,date,author_user_id,id_last_author,last_author,last_post,description) VALUES (:forum_id,:thread_name,:title,:text,:date,:author_user_id,:id_last_author,:last_author,:last_post,:description)";
			$q = $dbh->prepare($sql);
			$q->execute(array(':forum_id'=>$forum_id,
		              		  ':thread_name'=>$thread_name,
							  ':title'=>$title,
							  ':text'=>$text,
							  ':date'=>$date,
							  'author_user_id'=>$user,
							  'id_last_author'=>$id_last_author,
							  'last_author'=>$last_author,
			 				  'last_post'=>$date,
							  'description'=>$description));
			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function thread_update($id_threads, $thread_name, $description, $title, $text)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$date = date('Y-m-d H:i:s');

			$sql = "UPDATE forum_threads
	        SET thread_name=?,title=?,text=?,date=?,description=?
	        WHERE id_thread=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($thread_name,$title,$text,$date,$description,$id_threads));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_update($id_posts, $post_text)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$post_date= date('Y-m-d H:i:s');

			$sql = "UPDATE forum_posts
	        SET post_date=?,post_text=?
	        WHERE id_posts=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($post_date,$post_text,$id_posts));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update_stat($id_forums)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "UPDATE forums
	        SET threads_quantity=threads_quantity+1
	        WHERE id_forums=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_forums));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_update_stat2($id_threads)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "UPDATE forum_threads
	        SET posts_quantity=posts_quantity-1
	        WHERE id_thread=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_threads));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function view_count($id_threads)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "UPDATE forum_threads
	        SET hits_quantity=hits_quantity+1
	        WHERE id_thread=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_threads));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function post_update_stat3($id_forums)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "UPDATE forums
	        SET posts_quantity=posts_quantity-1
	        WHERE id_forums=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_forums));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

	public function forum_update_statdel($id_forums)
	{
		try {

			$dbh = new PDO("mysql::host=$this->hostname;dbname=$this->dbName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$sql = "UPDATE forums
	        SET threads_quantity=threads_quantity-1
	        WHERE id_forums=?";

			$q = $dbh->prepare($sql);
			$q->execute(array($id_forums));

			$dbh = NULL; // Закрываем соединение
		}

		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}

}