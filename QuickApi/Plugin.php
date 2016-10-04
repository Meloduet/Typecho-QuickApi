<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//include_once('QuickApi_Action.php');
/**
 * QuickApi
 * 
 * @package QuickApi 
 * @author Meloduet
 * @version 1.0.0
 * @link http://www.meloduet.com/
 */
class QuickApi_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
        Helper::addRoute("quick_api_route","/quickapi","QuickApi_Action",'action');
        
    }

    public static function deactivate()
    {
        Helper::removeRoute("quick_api_route");
    }

    public static function config(Typecho_Widget_Helper_Form $form)
    {

    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    public static function render()
    {

    }
}
