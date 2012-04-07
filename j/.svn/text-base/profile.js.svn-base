/**
 * Greenspace profile scripts
 * 
 *  @author Raymond Manalo
 *  @date 12/8/2010
 * 
 */

var PRF = 
{

	init:function()
	{
		$('#submit-btn').bind('click', function() {
			PRF.save_discussion();
		});
		
		$('#wall-status').bind('blur', function() {
			PRF.save_wall_status();
		});
		
		
		$('#login-submit').bind('click', function() {
			PRF.login_profile();
		});
		
	}

	,load_page:function(page, obj, id)
	{	
		//console.log(id);
		//console.log(obj);
		var user_id = '';
			user_id = $(obj).attr('user-id');
		$('#profile-right').html('<div style="margin:100px 250px; position:relative;"><img src="/images/screen/4_blue.gif" /><br />loading...</div>');
		$('#profile-right').load('/index.php/profile/'+ page + '/' + user_id, function() {
		  //alert('Load was performed.');
		}).hide().fadeIn('slow');
	}
	
	/**
	 * Login
	 */
	,login_profile:function()
	{
		var username = $('#username').attr('value');
		var password = $('#password').attr('value');
		type = $('#type').attr('value');
		
		var ajax = $.ajax({
			type: "POST",
			url: "/index.php/profile/form-action",
			//dataType: 'json',
			data: {
				status: status
				,submit:'submit'
				,type:'login'
			},
			success: function(r, status){
				//console.log(r);
				//console.log(status);
				PRF.load_page('mywall');
				//console.log(r.records.length);
				//loop the records
				
			}
		});
	}
	
	/**
	 * Starts a new discussion
	 * Adds an html div above the current listed discussion
	 * @param string type the type of discussion function
	 * @return void  
	 */
	,start_discussion:function(obj)
	{
		var user_id = '';
		user_id = $(obj).attr('user-id');
		//load the mydiscussions page
		$('#profile-right').html('<div style="margin:100px 250px; position:relative;"><img src="/images/screen/4_blue.gif" /><br />loading...</div>');
		$('#profile-right').load('/index.php/profile/mydiscussions/' + user_id, function() {
			
			//show / hide the div
			$("#startdiscussion_menu").toggle().hide().fadeIn('slow');      
			
		}).hide().fadeIn('slow');
	}
	
	/**
	 * Save a discussion
	 */
	,save_discussion:function()
	{
		title = $('#title').attr('value');
		//snippet = $('#snippet').attr('value');
		body = $('#body').attr('value');
		submit = $('#submit-btn').attr('value');
		//type = $('#type').attr('value');
		
		//console.log(title);
		//console.log(snippet);
		//console.log(body);
		//console.log(type);
		
		
		var ajax = $.ajax({
			type: "POST",
			url: "/index.php/profile/form-action",
			//dataType: 'json',
			data: {
				title: title
				//,snippet: snippet
				,body: body
				,submit:submit
				,type:'discussion'
			},
			success: function(r, status){
				//console.log(r);
				//console.log(status);
				PRF.load_page('mydiscussions');
				//console.log(r.records.length);
				//loop the records
				
			}
		});
	}
	

	/**
	 * Save group
	 */
	,save_group:function()
	{
		var status = $('#wall-status').attr('value');
		var ajax = $.ajax({
			type: "POST",
			url: "/index.php/profile/form-action",
			//dataType: 'json',
			data: {
				status: status
				,submit:'submit'
				,type:'group'
			},
			success: function(r, status){
				//console.log(r);
				//console.log(status);
				PRF.load_page('groups');
				//console.log(r.records.length);
				//loop the records
				
			}
		});
	}
	
	/**
	 * Save wall status
	 */
	,save_wall_status:function()
	{
		var status = $('#wall-status').attr('value');
		var ajax = $.ajax({
			type: "POST",
			url: "/index.php/profile/form-action",
			//dataType: 'json',
			data: {
				status: status
				,submit:'submit'
				,type:'wall'
			},
			success: function(r, status){
				//console.log(r);
				//console.log(status);
				PRF.load_page('mywall');
				//console.log(r.records.length);
				//loop the records
				
			}
		});
	}
	
		
}