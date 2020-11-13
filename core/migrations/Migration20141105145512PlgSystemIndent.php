<?php
/**
 * @package    hubzero-cms
 * @copyright  Copyright 2005-2019 HUBzero Foundation, LLC.
 * @license    http://opensource.org/licenses/MIT MIT
 */

use Hubzero\Content\Migration\Base;

// No direct access
defined('_HZEXEC_') or die();

/**
 * Migration script for removing the system plugin called 'indent'
 **/
class Migration20141105145512PlgSystemIndent extends Base
{
	/**
	 * Up
	 **/
	public function up()
	{
		$this->deletePluginEntry('system', 'indent');
	}

	/**
	 * Up
	 **/
	public function down()
	{
		$this->addPluginEntry('system', 'indent');
	}
}
