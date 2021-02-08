<?php

class ModBavioNewsHome
{
    public static function getMenuItem($menuId)
    {
       // Obtain a database connection.
       $db = JFactory::getDbo();
       $query = $db->getQuery(true);
       $query->select('*')->from('#__menu') ->where('id = '. $db->Quote($menuId));
       // Prepare the query
       $db->setQuery($query);
       // Load the row.
       return reset($db->loadObjectList()); 
    }

    public static function getArticlesFromCategories($includeSubCategories, $categories, $limit)
    {

        if($includeSubCategories){
            array_push ($categories, ...ModBavioNewsHome::getSubCategories($categories));
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from('#__content') 
            ->setLimit($limit)
            ->where('catid IN '. ModBavioNewsHome::quoteAndFormat($categories))
            ->order($db->quoteName('created') . 'DESC');;
        // Prepare the query
        $db->setQuery($query);
        return $db->loadObjectList(); 
    }


    private static function getSubCategories($categories) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id')->from('#__categories') ->where('parent_id IN'.  ModBavioNewsHome::quoteAndFormat($categories));
        $db->setQuery($query);
        return ModBavioNewsHome::flattenArray($db->loadObjectList()); 
    }
    
    private static function quoteAndFormat($arr){
        array_walk($arr, function(&$item) {
            $db = JFactory::getDbo();
            $item = $db->Quote($item);
        });
        return '(' . implode(',', $arr) . ')';
    }

    private static function flattenArray($items){
        $arr = [];
       foreach($items as $item) {
            $arr[] = $item->id;
       }
       return $arr;
    }
}