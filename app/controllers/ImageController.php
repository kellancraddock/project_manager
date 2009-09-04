<?php
	require_once('../app/models/ImageModel.php');
	require_once('../app/models/ProjectModel.php');
	class ImageController extends Zend_Controller_Action
	{
		public function init()
		{
			$this->user_session = new Zend_Session_Namespace('user');
			$this->image_model = new ImageModel();
			$this->project_model = new ProjectModel();
		}
		
		public function uploadAction()
		{
			$project_id = $this->_request->getParam('id');
			//Validate that project belongs to user here.
			$project_helper = $this->_helper->Projects;
			if($project_helper->isOwner($this->user_session->id, $project_id, $this->project_model)) {
			    
	            $adapter = new Zend_File_Transfer_Adapter_Http();
	            
	            foreach($adapter->getFileInfo() as $key => $file) {
	            	//Get extension
		            $path = split("[/\\.]", $file['name']);
					$ext = end($path);
	
					try {
						$adapter->addValidator('Extension', false, array('extension' => 'jpg,gif,png', 'case' => true));
						//Should probably use the array method below to enable overwriting
						$new_name = md5(rand()) .'-' . $project_id . '.' . $ext;
						//Add rename filter
						$adapter->addFilter('Rename', '/Applications/MAMP/htdocs/repositories/project_manager/public/uploads/' . $new_name);
					} catch(Zend_File_Transfer_Exception $e) {
						die($e->getMessage());
					}
					
		            try {
		            	//Store
		            	if ($adapter->receive($file['name'])) {
				        	$this->image_model->addOne($project_id, $new_name, $key);
				        }
		            } catch (Zend_File_Transfer_Exception $e) {
		            	die($e->getMessage());
		            }
	            }
	            header("Location: /account/project/id/{$project_id}");
            } else {
            	header("Location: /account");
            }
		}
		
		public function deleteAction()
		{
			$image_id = $this->_request->getParam('id');
			$project_id = $this->_request->getParam('project');
			
			//Varify Project Ownership
			$project_helper = $this->_helper->Projects;
			if($project_helper->isOwner($this->user_session->id, $project_id, $this->project_model)) {
				$this->image_model->deleteOne($image_id, $project_id);
			}
			
			header("Location: /account/addimages/id/{$project_id}");
			
		}
		
	}
	
?>