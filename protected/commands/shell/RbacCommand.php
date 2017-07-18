<?php 

class RbacCommand extends CConsoleCommand 
{
	private $_authManager;
	public function getHelp() 
	{
		/*
		return <<< EOD
			USAGE rbac
			DESCRIPTION This command generates an initial RBAC authorization hierarchy.
			EOD;
		*/
	}
	
	/** 
	* Execute the action. 
	* @param array command line parameters specific for this command 
	*/
	public function run($args) 
	{
		//ensure that an authManager is defined as this is mandatory for creating an auth heirarchy
		if(($this->_authManager=Yii::app()->authManager)===null)
		{
			echo "Error: an authorization manager, named 'authManager' must be configured to use this command.\n";
			echo "If you already added 'authManager' component in application configuration,\n";
			echo "please quit and re-enter the yiic shell.\n"; 
			return;
		}
		
		//provide the oportunity for the use to abort the request 
		echo "This command will create three roles: Owner, Member, and Reader and the following premissions:\n"; 
		echo "create, read, update and delete user\n"; 
		echo "create, read, update and delete event\n"; 
		echo "create, read, update and delete eventDay\n";
		echo "create, read, update and delete eventSession\n"; 
		echo "Would you like to continue? [Yes|No] ";
		
		//check the input from the user and continue if they indicated yes to the above question
		if(!strncasecmp(trim(fgets(STDIN)),'y',1))
		{
			//first we need to remove all operations, roles, child relationship and assignments
			$this->_authManager->clearAll();
			//create the lowest level operations for users 
			$this->_authManager->createOperation("createUser","create a new user"); 
			$this->_authManager->createOperation("readUser","read user profile information"); 
			$this->_authManager->createOperation("updateUser","update a users information"); 
			$this->_authManager->createOperation("deleteUser","remove a user from a event");
			//create the lowest level operations for events 
			$this->_authManager->createOperation("createEvent","create a new event"); 
			$this->_authManager->createOperation("readEvent","read event information"); 
			$this->_authManager->createOperation("updateEvent","update event information"); 
			$this->_authManager->createOperation("deleteEvent","delete a event"); 
			//create the lowest level operations for eventDays
			$this->_authManager->createOperation("createEventDay","create a new eventDay");
			$this->_authManager->createOperation("readEventDay","read eventDay information");
			$this->_authManager->createOperation("updateEventDay","update eventDay information");
			$this->_authManager->createOperation("deleteEventDay","delete an eventDay from a event");
			//create the lowest level operations for eventSessions
			$this->_authManager->createOperation("createEventSession","create a new eventSession");
			$this->_authManager->createOperation("readEventSession","read eventSession information");
			$this->_authManager->createOperation("updateEventSession","update eventSession information");
			$this->_authManager->createOperation("deleteEventSession","delete an eventSession from a event");
			//create the lowest level operations for eventAlerts
			$this->_authManager->createOperation("createEventAlert","create a new eventAlert");
			$this->_authManager->createOperation("readEventAlert","read eventAlert information");
			$this->_authManager->createOperation("updateEventAlert","update eventAlert information");
			$this->_authManager->createOperation("deleteEventAlert","delete an eventAlert from a event");
			//create the owner role, and add the appropriate permissions, as well as both the reader and member roles as children
			$role=$this->_authManager->createRole("owner"); 
			$role->addChild("createEventDay"); 
			$role->addChild("updateEventDay"); 
			$role->addChild("deleteEventDay");
			$role->addChild("createUser"); 
			$role->addChild("updateUser"); 
			$role->addChild("deleteUser"); 
			$role->addChild("createEventAlert"); 
			$role->addChild("updateEventAlert"); 
			$role->addChild("deleteEventAlert");
			$role->addChild("updateEventSession"); 
			$role->addChild("createEventSession"); 
			$role->addChild("deleteEventSession");
			$role->addChild("readUser"); 
			$role->addChild("readEvent"); 
			$role->addChild("readEventDay");
			$role->addChild("readEventSession");
			$role->addChild("updateEvent"); 
			//crate the admin role
			//create a general task-level permission for admins
			$this->_authManager->createTask("adminManagement", "access to the application administration functionality");
			//create the site admin role, and add the appropriate permissions
			$role=$this->_authManager->createRole("admin");
			$role->addChild("owner"); 
			$role->addChild("deleteEvent");
			$role->addChild("createEvent"); 
			$role->addChild("adminManagement");
			//ensure we have one admin in the system (force it to be user id #1)
			$this->_authManager->assign("admin",1);
			$this->_authManager->assign("owner", 2);
			//provide a message indicating success 
			echo "Authorization hierarchy successfully generated.";
		}
	}
}

?>

		
	