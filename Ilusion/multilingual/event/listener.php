<?php
namespace Ilusion\multilingual\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $user;
	protected $path_helper;
	
	public function __construct(\phpbb\user $user, \phpbb\path_helper $path_helper)
	{
		$this->user = $user;
		$this->path_helper = $path_helper;
	}
	
	static public function getSubscribedEvents()
	{
		return array(
			'core.display_forums_modify_template_vars'				=> 'forums_display',
			'core.display_forums_modify_category_template_vars'		=> 'category_display',
			'core.generate_forum_nav'								=> 'navlinks_display',
			'core.viewforum_modify_page_title'						=> 'viewforum_title_display',
			'core.make_jumpbox_modify_tpl_ary'						=> 'jumpbox_display',
			'core.viewtopic_assign_template_vars_before'			=> 'viewtopic_forum_display',
			'core.search_modify_tpl_ary'							=> 'search_results_display',
			'core.mcp_forum_view_before'							=> 'mcp_forum_title_display',
		);
	}
	
	public function forums_display($event)
	{
		$forum_row = $event['forum_row'];
		$forum_name = $forum_row['FORUM_NAME'];
		//var_dump($forum_name);

		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$forum_row['FORUM_NAME'] = $explode_array[$index];
			$event['forum_row'] = $forum_row;
		}
	}
	
	public function category_display($event)
	{
		$forum_row = $event['cat_row'];
		$forum_name = $forum_row['FORUM_NAME'];
		
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$forum_row['FORUM_NAME'] = $explode_array[$index];
			$event['cat_row'] = $forum_row;
		}
	}
	
	public function navlinks_display($event)
	{
		// forum_data
		$forum_row = $event['forum_data'];
		$forum_name = $forum_row['FORUM_NAME'];
		
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$forum_row['FORUM_NAME'] = $explode_array[$index];
			$event['forum_data'] = $forum_row;
		}
		
		// forum_template_data
		$forum_row = $event['forum_template_data'];
		$forum_name = $forum_row['FORUM_NAME'];
		
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$forum_row['FORUM_NAME'] = $explode_array[$index];
			$event['forum_template_data'] = $forum_row;
		}
		
		// navlinks_parents
		$navlinks = $event["navlinks_parents"];
		for ($i = 0; $i < count($navlinks); $i++)
		{
			$row = $navlinks[$i];
			$forum_name = $row['BREADCRUMB_NAME'];
			
			$explode_array = explode('|', $forum_name);
			if (count($explode_array) == 2)
			{
				$user_lang = $this->user->data['user_lang'];
				$index = ($user_lang == 'en') ? 0 : 1;
				$row['BREADCRUMB_NAME'] = $explode_array[$index];
				$navlinks[$i] = $row;
			}
		}
		
		$event['navlinks_parents'] = $navlinks;
		
		// navlink
		$forum_row = $event['navlinks'];
		$forum_name = $forum_row['BREADCRUMB_NAME'];
		
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$forum_row['BREADCRUMB_NAME'] = $explode_array[$index];
			$event['navlinks'] = $forum_row;
		}
	}
	
	public function viewforum_title_display($event)
	{		
		$forum_name = $event['page_title'];
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$event['page_title'] = $explode_array[$index];
		}
	}
	
	public function jumpbox_display($event)
	{
		$forums = $event["tpl_ary"];
		for ($i = 0; $i < count($forums); $i++)
		{
			$row = $forums[$i];
			$forum_name = $row['FORUM_NAME'];
			
			$explode_array = explode('|', $forum_name);
			if (count($explode_array) == 2)
			{
				$user_lang = $this->user->data['user_lang'];
				$index = ($user_lang == 'en') ? 0 : 1;
				$row['FORUM_NAME'] = $explode_array[$index];
				$forums[$i] = $row;
			}
		}
		
		$event['tpl_ary'] = $forums;
	}
	
	public function viewtopic_forum_display($event)
	{
		$topic_data = $event["topic_data"];
		$forum_name = $topic_data['forum_name'];
		
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$topic_data['forum_name'] = $explode_array[$index];
			$event["topic_data"] = $topic_data;
		}
	}
	
	public function search_results_display($event)
	{
		$topic_data = $event["tpl_ary"];
		$forum_name = $topic_data['FORUM_TITLE'];
		
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$topic_data['FORUM_TITLE'] = $explode_array[$index];
			$event["tpl_ary"] = $topic_data;
		}
	}
	
	public function mcp_forum_title_display($event)
	{
		$topic_data = $event["forum_info"];
		$forum_name = $topic_data['forum_name'];
		
		$explode_array = explode('|', $forum_name);
		if (count($explode_array) == 2)
		{
			$user_lang = $this->user->data['user_lang'];
			$index = ($user_lang == 'en') ? 0 : 1;
			$topic_data['forum_name'] = $explode_array[$index];
			$event["forum_info"] = $topic_data;
		}
	}
}