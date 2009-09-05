<?php
	Class CommentModel extends Zend_Db_Table_Abstract
	{
		public $table = "comments";
		
		function addOne($project_id, $user_id, $comment)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'project_id'        => $project_id,
				'user_id'         => $user_id,
				'comment'         => $comment
				);
			//Insert into table
			$db->insert($this->table, $insertArgs);
			return true;
		}
		
		function deleteOne($comment_id, $user_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to select statement
			$where = "id = '{$comment_id}' AND user_id = '{$user_id}'";
		
			//Delete from table
			return $db->delete($this->table, $where);
		}
		
		function getAll($project_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE project_id = {$project_id}";
		
			//Select from table
			$comment_array = $db->fetchAll($select);
			
			//Build array
			$return_array = array();
			foreach ($comment_array as $comment) {
				$return_array[$comment['id']] = array("user_id" => $comment['user_id'], "comment" => $comment['comment']);
			}
			
			return $return_array;
		}
	}
?>