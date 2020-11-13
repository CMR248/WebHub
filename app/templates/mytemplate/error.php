<?php
/**
 * @package    hubzero-cms
 * @copyright  Copyright 2005-2019 HUBzero Foundation, LLC.
 * @license    http://opensource.org/licenses/MIT MIT
 */

// Get browser info to set some classes
$browser = new \Hubzero\Browser\Detector();
$cls = array(
	'no-js',
	$browser->name(),
	$browser->name() . $browser->major(),
	$this->direction
);

$code = (is_numeric($this->error->getCode()) && $this->error->getCode() > 100 ? $this->error->getCode() : 500);

Lang::load('tpl_' . $this->template) ||
Lang::load('tpl_' . $this->template, __DIR__);
?>
<!DOCTYPE html>
<html dir="<?php echo $this->direction; ?>" lang="<?php echo $this->language; ?>" class="<?php echo implode(' ', $cls); ?>">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<title><?php echo Config::get('sitename') . ' - ' . $code; ?></title>

		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/error.css?v=<?php echo filemtime(__DIR__ . '/css/error.css'); ?>" />

		<!--[if IE 9]>
			<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/browser/ie9.css" />
		<![endif]-->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/html5.js"></script>
			<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/browser/ie8.css" />
		<![endif]-->
	</head>
	<body id="error-page">

		<div id="errorbox">
			<header id="masthead">
				<h1>
					<a href="<?php echo empty($this->baseurl) ? '/' : $this->baseurl; ?>" title="<?php echo Config::get('sitename'); ?>">
						<span><?php echo Config::get('sitename'); ?></span>
					</a>
				</h1>
				<p class="tagline"><?php echo Lang::txt('TPL_MYTEMPLATE_TAGLINE'); ?></p>
			</header>

			<main id="content" class="<?php echo 'code' . $this->error->getCode(); ?>">
				<div class="inner">
					<h2 class="error-code">
						<?php echo $code; ?>
					</h2>

					<p class="error"><?php 
						if ($this->debug)
						{
							$message = $this->error->getMessage();
						}
						else
						{
							switch ($this->error->getCode())
							{
								case 404:
									$message = Lang::txt('TPL_MYTEMPLATE_404_HEADER');
									break;
								case 403:
									$message = Lang::txt('TPL_MYTEMPLATE_403_HEADER');
									break;
								case 500:
								default:
									$message = Lang::txt('TPL_MYTEMPLATE_500_HEADER');
									break;
							}
						}
						echo $message;
					?></p>
				</div><!-- / .inner -->
			</main><!-- / #content -->

			<footer id="footer">
				<p class="copyright">
					<?php echo Lang::txt('TPL_MYTEMPLATE_COPYRIGHT', Request::root(), Config::get('sitename'), date("Y")); ?>
				</p>
			</footer><!-- / #footer -->
		</div><!-- / #wrap -->

		<?php if ($this->debug) { ?>
			<div class="backtrace-wrap">
				<?php echo $this->renderBacktrace(); ?>
			</div>
		<?php } ?>
	</body>
</html>