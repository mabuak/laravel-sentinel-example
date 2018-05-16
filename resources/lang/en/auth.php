<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Authentication Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines are used during authentication for various
	| messages that we need to display to the user. You are free to modify
	| these language lines according to your application's requirements.
	|
	*/
	
	'failed'                                                => 'These credentials do not match our records.',
	'throttle'                                              => 'Too many login attempts. Please try again in :seconds seconds.',
	
	// Login
	'login_heading'                                         => 'Login',
	'login_subheading'                                      => 'Please login with your email/username and password below.',
	'login_identity_label'                                  => 'Email:',
	'login_identity_placeholder'                            => 'Enter Email',
	'login_password_label'                                  => 'Password:',
	'login_password_placeholder'                            => 'Enter Password',
	'login_remember_label'                                  => 'Remember Me',
	'login_submit_btn'                                      => 'Login',
	'login_forgot_password'                                 => 'Forgot your password?',
	'login_sign_in'                                         => 'Sign In',
	
	// Index
	'index_users'                                           => 'Users',
	'index_name_th'                                         => 'Name',
	'index_fname_th'                                        => 'First Name',
	'index_lname_th'                                        => 'Last Name',
	'index_email_th'                                        => 'Email',
	'index_groups_th'                                       => 'Groups',
	'index_status_th'                                       => 'Status',
	'index_action_th'                                       => 'Action',
	'index_active_link'                                     => 'Active',
	'index_inactive_link'                                   => 'Inactive',
	'index_create_link'                                     => 'Add New',
	'index_roles'                                           => 'Roles',
	'index_acl'                                             => 'Access Control List',
	'index_column'                                          => 'Column',
	'index_last_login'                                      => 'Last Login',
	'index_created_at'                                      => 'Created At',
	'index_updated_at'                                      => 'Updated At',
	'index_created_by'                                      => 'Created By',
	'index_updated_by'                                      => 'Updated By',
	'index_slug_th'                                         => 'Slug',
	
	// Activate User
	'activate_heading'                                      => 'Activate User',
	'activate_subheading'                                   => 'Are you sure you want to activate the user \':name\'?',
	'activate_this_user'                                    => 'Click to activate this user',
	
	// Deactivate User
	'deactivate_heading'                                    => 'Deactivate User',
	'deactivate_subheading'                                 => 'Are you sure you want to deactivate the user \':name\'?',
	'deactivate_this_user'                                  => 'Click to deactivate this user',
	
	// Form
	'form_user_heading'                                     => 'User',
	'form_user_subheading'                                  => 'Please enter the user\'s information below.',
	'form_user_fname_label'                                 => 'First Name',
	'form_user_lname_label'                                 => 'Last Name',
	'form_user_company_label'                               => 'Company Name',
	'form_user_identity_label'                              => 'Identity',
	'form_user_email_label'                                 => 'Email',
	'form_user_phone_label'                                 => 'Phone',
	'form_user_password_label'                              => 'Password',
	'form_user_password_confirm_label'                      => 'Confirm Password',
	'form_user_submit_btn'                                  => 'Create Account',
	'form_user_cancel_btn'                                  => 'Cancel',
	'form_user_validation_fname_label'                      => 'First Name',
	'form_user_validation_lname_label'                      => 'Last Name',
	'form_user_validation_identity_label'                   => 'Identity',
	'form_user_validation_email_label'                      => 'Email Address',
	'form_user_validation_phone_label'                      => 'Phone',
	'form_user_validation_company_label'                    => 'Company Name',
	'form_user_validation_password_label'                   => 'Create a password',
	'form_user_validation_password_confirm_label'           => 'Retype your password',
	'form_user_role_label'                                  => 'Role',
	'form_user_role_select'                                 => 'Select Role',
	'form_user_password_long'                               => 'Password (at least 8 characters long)',
	'form_user_password_type_again'                         => 'Type Your Password Again',
	
	// Edit User
	'edit_user_heading'                                     => 'Edit User',
	'edit_user_subheading'                                  => 'Please enter the user\'s information below.',
	'edit_user_fname_label'                                 => 'First Name',
	'edit_user_lname_label'                                 => 'Last Name:',
	'edit_user_company_label'                               => 'Company Name:',
	'edit_user_email_label'                                 => 'Email:',
	'edit_user_phone_label'                                 => 'Phone:',
	'edit_user_password_label'                              => 'Password: (if changing password)',
	'edit_user_password_confirm_label'                      => 'Confirm Password: (if changing password)',
	'edit_user_groups_heading'                              => 'Member of groups',
	'edit_user_submit_btn'                                  => 'Save User',
	'edit_user_validation_fname_label'                      => 'First Name',
	'edit_user_validation_lname_label'                      => 'Last Name',
	'edit_user_validation_email_label'                      => 'Email Address',
	'edit_user_validation_phone_label'                      => 'Phone',
	'edit_user_validation_company_label'                    => 'Company Name',
	'edit_user_validation_groups_label'                     => 'Groups',
	'edit_user_validation_password_label'                   => 'Password',
	'edit_user_validation_password_confirm_label'           => 'Password Confirmation',
	
	// Create Group
	'create_role_title'                                    => 'Create Role',
	'create_role_heading'                                  => 'Create Role',
	'create_role_subheading'                               => 'Please enter the role information below.',
	'create_role_name_label'                               => 'Role Name:',
	'create_role_desc_label'                               => 'Description:',
    'create_role_submit_btn'                               => 'Create Role',
	'create_role_validation_name_label'                    => 'Role Name',
	'create_role_validation_desc_label'                    => 'Description',
 
	
	// Edit Role
	'edit_role_title'                                      => 'Edit Role',
	'edit_role_saved'                                      => 'Role Saved',
	'edit_role_heading'                                    => 'Edit Role',
	'edit_role_subheading'                                 => 'Please enter the role information below.',
	'edit_role_name_label'                                 => 'Role Name:',
	'edit_role_desc_label'                                 => 'Description:',
	'edit_role_submit_btn'                                 => 'Save Role',
	'edit_role_validation_name_label'                      => 'Role Name',
	'edit_role_validation_desc_label'                      => 'Description',
	
	// Change Password
	'change_password_heading'                               => 'Change Password',
	'change_password_old_password_label'                    => 'Old Password',
	'change_password_new_password_label'                    => 'New Password',
	'change_password_new_password_confirm_label'            => 'Confirm New Password',
	'change_password_submit_btn'                            => 'Change Password',
	'change_password_validation_old_password_label'         => 'Old Password',
	'change_password_validation_new_password_label'         => 'New Password',
	'change_password_validation_new_password_confirm_label' => 'Confirm New Password',
	
	// Forgot Password
	'forgot_password_heading'                               => 'Forgot Password',
	'forgot_password_subheading'                            => 'Please Enter your <b>Email</b> and instructions will be sent to you!',
	'forgot_password_email_label'                           => '%s:',
	'forgot_password_submit_btn'                            => 'Submit',
	'forgot_password_validation_email_label'                => 'You Email Address',
	'forgot_password_identity_label'                        => 'Identity',
	'forgot_password_email_identity_label'                  => 'Email',
	'forgot_password_email_not_found'                       => 'No record of that email address.',
	'forgot_password_identity_not_found'                    => 'No record of that username.',
	
	// Reset Password
	'reset_password_heading'                                => 'Change Password',
	'reset_password_new_password_label'                     => 'New Password (at least %s characters long):',
	'reset_password_new_password_confirm_label'             => 'Confirm New Password:',
	'reset_password_submit_btn'                             => 'Change',
	'reset_password_validation_new_password_label'          => 'New Password',
	'reset_password_validation_new_password_confirm_label'  => 'Confirm New Password',
	'reset_password_change_unsuccessful_old'                => 'Old Password does not match',
 
	// Account Creation
	'account_creation_successful'                           => 'Account Successfully Created',
	'account_creation_unsuccessful'                         => 'Unable to Create Account',
	'account_creation_duplicate_email'                      => 'Email Already Used or Invalid',
	'account_creation_duplicate_identity'                   => 'Identity Already Used or Invalid',
	'account_creation_missing_default_group'                => 'Default group is not set',
	'account_creation_invalid_default_group'                => 'Invalid default group name set',
	'account_creation_register'                             => 'Register',
	
	// Password
	'password_change_successful'                            => 'Password Successfully Changed',
	'password_change_unsuccessful'                          => 'Unable to Change Password',
	'forgot_password_successful'                            => 'Password Reset Email Sent',
	'forgot_password_unsuccessful'                          => 'Unable to email the Reset Password link',
	
	// Activation
	'activate_successful'                                   => 'Account Activated',
	'activate_unsuccessful'                                 => 'Unable to Activate Account',
	'active_current_user_unsuccessful'                      => 'You cannot Activate your self.',
	'deactivate_successful'                                 => 'Account De-Activated',
	'deactivate_unsuccessful'                               => 'Unable to De-Activate Account',
	'activation_email_successful'                           => 'Activation Email Sent. Please check your inbox or spam',
	'activation_email_unsuccessful'                         => 'Unable to Send Activation Email',
	
	// Login / Logout
	'login_successful'                                      => 'Logged In Successfully',
	'login_unsuccessful'                                    => 'Incorrect Login',
	'login_unsuccessful_not_active'                         => 'Account is inactive',
	'login_timeout'                                         => 'Temporarily Locked Out.  Try again later.',
	'logout_successful'                                     => 'Logged Out Successfully',
	'logout_heading'                                        => 'Logout',
	
	
	// Account Changes
	'update_successful'                                     => 'Account Information Successfully Updated',
	'update_unsuccessful'                                   => 'Unable to Update Account Information',
	'delete_successful'                                     => 'User Deleted',
	'delete_unsuccessful'                                   => 'Unable to Delete User',
	'delete_confirmation'                                   => 'Are you sure you want to delete user \':name\'?',
	'delete_confirmation_heading'                           => 'Delete this entry ?',
	
	// Role
	'role_creation_successful'                              => 'Role Successfully Created',
	'role_already_exists'                                   => 'Role name already taken',
	'role_update_successful'                                => 'Role details updated',
	'role_delete_successful'                                => 'Role deleted',
	'role_delete_unsuccessful'                              => 'Unable to delete role',
	'role_delete_notallowed'                                => 'Can\'t delete the root\' role',
	'role_name_required'                                    => 'Group name is a required field',
	'role_name_admin_not_alter'                             => 'Admin group name can not be changed',
	
	// Activation Email
	'email_activation_subject'                              => 'Account Activation',
	'email_activate_heading'                                => 'Activate account for %s',
	'email_activate_subheading'                             => 'Please click this link to %s.',
	'email_activate_link'                                   => 'Activate Your Account',
 
	// Forgot Password Email
	'email_forgotten_password_subject'                      => 'Forgotten Password Verification',
	'email_forgot_password_heading'                         => 'Reset Password for %s',
	'email_forgot_password_subheading'                      => 'Please click this link to %s.',
	'email_forgot_password_link'                            => 'Reset Your Password',
	
	// New Password Email
	'email_new_password_subject'                            => 'New Password',
	'email_new_password_heading'                            => 'New Password for %s',
	'email_new_password_subheading'                         => 'Your password has been reset to: %s',
	
	// Delete
	'deactivate_current_user_unsuccessful'                  => 'You cannot De-Activate your self.',
	'delete_account'                                        => 'Account Successfully Delete',
];
