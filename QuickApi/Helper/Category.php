<?php
class QuickApi_Helper_Category
{
    /**
     * 获取所有分类
     * @return array
     */
    function getCategories()
    {
        $db= Typecho_Db::get();
        $query = $db->select('mid','name','slug','description','count','order','parent')
                    ->from('table.metas')->where('type = ?',"category");
        $result = $db->fetchAll($query);
        return $result;
    }
    
    /**
     * 获取文章所属分类
     * @param $cid 文章的cid
     * @return array
     */
    function getCategoryByCid($cid)
    {
        $db= Typecho_Db::get();
        $query = $db->select('mid')
                    ->from('table.relationships')->where('cid = ?',$cid);
        $fetch = $db->fetchRow($query);
        if(!array_key_exists('mid',$fetch))
            return false;
        $mid = $fetch['mid'];        
        $query = $db->select('mid','name','slug','description','count','order','parent')
                    ->from('table.metas')->where('type = ? and mid = ?',"category",$mid);
        $result  = $db->fetchRow($query);
        return $result;
    }
    
    /**
     * 获取指定分类下的所有文章的id
     * @param $mid 分类id
     * @return array
     */
    function getCidsByMid($mid)
    {
        $db= Typecho_Db::get();
        $query = $db->select('cid')
                    ->from('table.relationships')->where('mid = ?',$mid);
        $result = $db->fetchAll($query);
        $arr = array();
        foreach($result as $item)
        {
            $arr[] = (int)$item['cid'];
        }
        return $arr;
    }
    
    
}