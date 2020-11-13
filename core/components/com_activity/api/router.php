<?php
/**
 * @package    hubzero-cms
 * @copyright  Copyright 2005-2019 HUBzero Foundation, LLC.
 * @license    http://opensource.org/licenses/MIT MIT
 */

namespace Components\Activity\Api;

use Hubzero\Component\Router\Base;

/**
 * Routing class for the component
 */
class Router extends Base
{
	/**
	 * Build the route for the component.
	 *
	 * @param   array  &$query  An array of URL arguments
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 */
	public function build(&$query)
	{
		$segments = array();

		if (!empty($query['controller']))
		{
			$segments[] = $query['controller'];
			unset($query['controller']);
		}

		if (!empty($query['task']))
		{
			$segments[] = $query['task'];
			unset($query['task']);
		}

		return $segments;
	}

	/**
	 * Parse the segments of a URL.
	 *
	 * @param   array  &$segments  The segments of the URL to parse.
	 * @return  array  The URL attributes to be used by the application.
	 */
	public function parse(&$segments)
	{
		$vars = array();

		$vars['controller'] = 'entries';

		if (isset($segments[0]))
		{
			//  /blog
			//  /blog/list
			//  /blog/##
			//  /blog/##/comments
			//  /blog/##/comments/##
			if (is_numeric($segments[0]))
			{
				$vars['id'] = $segments[0];
				if (\App::get('request')->method() == 'GET')
				{
					$vars['task'] = 'read';
				}
			}
			else
			{
				$vars['task'] = $segments[0];
			}

			if (isset($segments[1]))
			{
				if ($segments[1] == 'comments')
				{
					$vars['controller'] = $segments[1];
					$vars['task'] = 'list';
				}
				else
				{
					$vars['task'] = $segments[1];
				}
			}
		}

		return $vars;
	}
}