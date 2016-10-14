<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Panel management, includes: 
 * 	- Admin Users CRUD
 * 	- Admin User Groups CRUD
 * 	- Admin User Reset Password
 * 	- Account Settings (for login user)
 */
class Panel extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->library('session');
		$this->mTitle = 'Admin Panel - ';
	}

	// Admin Users CRUD
	public function admin_user()
	{
		$this->mTitle.= 'Admin Users';
		$allUser = $this->ion_auth->all_admin()->result();
		$this->mViewData['users'] = $allUser;
		$this->render('panel/admin_user_list');

	}

	// Create Admin User
	public function admin_user_create()
	{
		// (optional) only top-level admin user groups can create Admin User
		$this->verify_auth(array('webmaster'));


		$form = $this->form_builder->create_form('','',array('id'=>'frmVal','novalidate'=>'novalidate'));
                $form->set_rule_group('panel/admin_user_create');
		if ($form->validate())
		{
			// passed validation
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$additional_data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);
			$groups = $this->input->post('groups');
			$status = $this->input->post('status');


			// create user (default group as "members")
			$user = $this->ion_auth->register_new($username, $password, $email, $additional_data, $groups, $status);
			if ($user)
			{
				// success
				$messages = 'Admin created successfully.';
				$this->system_message->set_success($messages);
                                redirect('admin/panel/admin_user');
			}
			else
			{
                                $form_data = (object)$this->input->post();
                                $this->mViewData['form_data'] = $form_data;
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
//			refresh();
		} else {
                    $form_data = (object)$this->input->post();
                    $this->mViewData['form_data'] = $form_data;
                }

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);	// disable creation of "webmaster" account
		$this->mViewData['groups'] = $groups;
		$this->mTitle.= 'Create Admin User';

		$this->mViewData['form'] = $form;
		$this->render('panel/admin_user_create');
	}

        
        // Create Admin Group
	public function admin_user_create_group()
	{
		// (optional) only top-level admin user groups can create Admin User
		$this->verify_auth(array('webmaster'));


		$form = $this->form_builder->create_form('','',array('id'=>'frmVal','novalidate'=>'novalidate'));
                $form->set_rule_group('panel/admin_user_create_group');
		if ($form->validate())
		{
			// passed validation
			$name = $this->input->post('name');
			$description = $this->input->post('description');

			// create user (default group as "members")
			$group = $this->ion_auth->create_group($name, $description);
			if ($group)
			{
				// success
				$messages = 'Group created successfully.';
				$this->system_message->set_success($messages);
                                redirect('admin/panel/admin_user_group');
			}
			else
			{
                                $form_data = (object)$this->input->post();
                                $this->mViewData['form_data'] = $form_data;
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
//			refresh();
		} else {
                    $form_data = (object)$this->input->post();
                    $this->mViewData['form_data'] = $form_data;
                }

		$this->mTitle.= 'Create Group';

		$this->mViewData['form'] = $form;
		$this->render('panel/admin_user_create_group');
	}
        
        
        
        // Create Admin Group
	public function admin_user_edit_group($group_id)
	{
		// (optional) only top-level admin user groups can create Admin User
		$this->verify_auth(array('webmaster'));

                $group_data = $this->ion_auth->group($group_id)->result();
                $form = $this->form_builder->create_form('','',array('id'=>'frmVal','novalidate'=>'novalidate'));
                $form->set_rule_group('panel/admin_user_create_group');
		if ($form->validate())
		{
			// passed validation
			$name = $this->input->post('name');
			$description = $this->input->post('description');

			// create user (default group as "members")
			$group = $this->ion_auth->update_group($group_id,$name, $description);
			if ($group)
			{
				// success
				$messages = 'Group updated successfully.';
				$this->system_message->set_success($messages);
                                redirect('admin/panel/admin_user_group');
			}
			else
			{
                                $form_data = (object)$this->input->post();
                                $this->mViewData['form_data'] = $form_data;
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
//			refresh();
		} else {
                    $form_data = (object)$this->input->post();
                    $this->mViewData['form_data'] = $form_data;
                }

		$this->mTitle.= 'Edit Group';
                $this->mViewData['form_data'] = $group_data[0];
		$this->mViewData['form'] = $form;
		$this->render('panel/admin_user_create_group');
	}
        
        
        
	// Create Admin User
	public function admin_user_delete($user_id)
	{
		// (optional) only top-level admin user groups can create Admin User
		$this->verify_auth(array('webmaster'));
		$this->ion_auth->delete_user($user_id);
		redirect('admin/panel/admin_user');
	
	}

        // Delete user group
	public function admin_user_group_delete($group_id)
	{
            // (optional) only top-level admin user groups can create Admin User
            $this->verify_auth(array('webmaster'));
            $delete = $this->ion_auth->delete_admin_group($group_id);
            if(!$delete){
                $errors = $this->ion_auth->errors(false);
                $this->system_message->set('error',$errors);
            }
            redirect('admin/panel/admin_user_group');
	
	}


	// Create Admin User
	public function admin_user_edit($user_id)
	{
		// (optional) only top-level admin user groups can create Admin User
		$this->verify_auth(array('webmaster'));

		$user_data = $this->ion_auth->get_user_data($user_id)->result();

		$form = $this->form_builder->create_form('','',array('id'=>'frmVal'));
		$form->set_rule_group('panel/admin_user_edit');
		if ($form->validate())
		{
			// passed validation
			$username = $this->input->post('username');
			$additional_data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);
			$groups = $this->input->post('groups');
			$status = $this->input->post('status');

			// create user (default group as "members")
			$user = $this->ion_auth->register_update($username, $additional_data, $groups, $status,$user_id);
			if ($user)
			{
				// success
				$messages = 'Admin updated successfully.';
				$this->system_message->set_success($messages);
                                redirect('admin/panel/admin_user_group');
			}
			else
			{
                            
                                $user_data[0]->first_name = $this->input->post('first_name');
                                $user_data[0]->last_name = $this->input->post('last_name');
                                $user_data[0]->group_id = $this->input->post('groups');
                                $user_data[0]->status = $this->input->post('status');
                                $user_data[0]->username = $this->input->post('username');
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			//refresh();
		}

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);	// disable creation of "webmaster" account
		$this->mViewData['groups'] = $groups;
		$this->mViewData['user_data'] = $user_data;
		$this->mTitle.= 'Edit Admin User';

		$this->mViewData['form'] = $form;
		$this->render('panel/admin_user_edit');
	}



	// Admin User Groups CRUD
	public function admin_user_group()
	{
            $form = $this->form_builder->create_form();
            $this->mTitle.= 'Admin User Groups';
            $allGroup = $this->ion_auth->groups()->result();
            
            $this->system_message->render();
            $this->mViewData['groups'] = $allGroup;
            $this->mViewData['form'] = $form;
            $this->render('panel/admin_user_group');
	}

	// Admin User Reset password
	public function admin_user_reset_password($user_id)
	{
		// only top-level users can reset Admin User passwords
		$this->verify_auth(array('webmaster'));

		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			// pass validation
			$data = array('password' => $this->input->post('new_password'));
			if ($this->ion_auth->update($user_id, $data))
			{
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
			}
			else
			{
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			refresh();
		}

		$this->load->model('admin_user_model', 'admin_users');
		$target = $this->admin_users->get($user_id);
		$this->mViewData['target'] = $target;

		$this->mViewData['form'] = $form;
		$this->mTitle.= 'Reset Admin User Password';
		$this->render('panel/admin_user_reset_password');
	}
        
        // Admin group action
	public function admin_group_action($group_id)
	{
            if($group_id == 1){
                redirect('admin/panel/admin_user_group');
            }
		// only top-level users can reset Admin User passwords
		$this->verify_auth(array('webmaster'));
                $group_data = $this->ion_auth->group($group_id)->result();
                $group_action_data = $this->ion_auth->get_users_group_action($group_id)->result();
		$form = $this->form_builder->create_form();
		if ($this->input->post())
		{
                    // pass validation
                    $all_action = $this->input->post('group_action');
                    $this->ion_auth->remove_users_group_permision($group_id);
                    foreach($all_action as $val){
                        $data = array('admin_users_action_id'=>$val,'admin_groups_id'=>$group_id);
                        $this->ion_auth->add_users_group_permision($data);
                    }
                    redirect('admin/panel/admin_user_group');
		}
		$this->mViewData['group_data'] = $group_data[0];
		$this->mViewData['group_action'] = $group_action_data;
		$this->mViewData['form'] = $form;
		$this->mTitle.= 'Group Permision';
		$this->render('panel/admin_group_action');
	}

        

	// Account Settings
	public function account()
	{
		// Update Info form
		$form1 = $this->form_builder->create_form('admin/panel/account_update_info');
		$form1->set_rule_group('panel/account_update_info');
		$this->mViewData['form1'] = $form1;

		// Change Password form
		$form2 = $this->form_builder->create_form('admin/panel/account_change_password');
		$form1->set_rule_group('panel/account_change_password');
		$this->mViewData['form2'] = $form2;

		$this->mTitle = "Account Settings";
		$this->render('panel/account');
	}

	// Submission of Update Info form
	public function account_update_info()
	{
		$data = $this->input->post();
		if ($this->ion_auth->update($this->mUser->id, $data))
		{
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
		}
		else
		{
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
		}

		redirect('admin/panel/account');
	}

	// Submission of Change Password form
	public function account_change_password()
	{
		$data = array('password' => $this->input->post('new_password'));
		if ($this->ion_auth->update($this->mUser->id, $data))
		{
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
		}
		else
		{
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
		}

		redirect('admin/panel/account');
	}
	
	/**
	 * Logout user
	 */
	public function logout()
	{
		$this->ion_auth->logout();
		redirect('admin/login');
	}
}
