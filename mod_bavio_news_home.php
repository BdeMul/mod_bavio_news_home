<?php
defined('_JEXEC') or die;
use Joomla\CMS\Helper\ModuleHelper;
require_once dirname(__FILE__) . '/helper.php';

$sub_title = $params->get('sub_title', 'UNKNOWN');
$title = $params->get('title', 'UNKNOWN');
$read_more = $params->get('read_more', 'UNKNOWN');
$url_text = $params->get('url_text', 'UNKNOWN');
$menu_item = ModBavioNewsHome::getMenuItem($params->get('menu_item', '-1'));
$articles = ModBavioNewsHome::getArticlesFromCategories($params->get('sub-categories', '0'), $params->get('categories', []), $params->get('limit', 6));
require ModuleHelper::getLayoutPath('mod_bavio_news_home', $params->get('layout', 'default'));