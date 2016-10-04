<?php
class QuickApi_Helper_Content
{
    /**
     * 获取Contents
     * @param $offset 偏移量
     * @param $limit 数量
     * @return array
     */
    function getContents($offset, $limit)
    {
        $db= Typecho_Db::get();
        $query = $db->select('cid','slug','title','text','commentsNum','created','modified')
                    ->from('table.contents')->where('status = ?', "publish")
                    ->offset($offset)->limit($limit);
        $result = $db->fetchAll($query);
        return $result;
    }
    
    /**
     * 获取Contents的简要信息
     * @param $offset 偏移量
     * @param $limit 数量
     * @return array
     */
    function getBriefContents($offset, $limit)
    {
        $db= Typecho_Db::get();
        $query = $db->select('cid','slug','title','commentsNum')
                    ->from('table.contents')->where('status = ?', "publish")
                    ->offset($offset)->limit($limit);
        $result = $db->fetchAll($query);
        return $result;
    }
    //TODO: FIX
    function getBriefContentsWithCategory($offset, $limit)
    {
        $db= Typecho_Db::get();
        $query = $db->select('cid','slug','title','commentsNum')
                    ->from('table.contents')->where('status = ?', "publish")
                    ->offset($offset)->limit($limit);
        $result = $db->fetchAll($query);
        return $result;
    }
    
    /**
     * 获取Contents的总量
     * @return string json
     */
    function getContentsCount()
    {//select count(*) from table
        $db= Typecho_Db::get();
        $prefix = $db->getPrefix();
        $query = $db->query('SELECT COUNT(*) FROM '.$prefix.'contents');
        $result = $db->fetchRow($query);
        return array('count'=>$result['COUNT(*)']);
    }
    
    /**
     * 获取Contents的总量
     * @return string json
     */
    function getPublishContentsCount()
    {//select count(*) from table
        $db= Typecho_Db::get();
        $prefix = $db->getPrefix();
        $query = $db->query('SELECT COUNT(*) FROM '.
        $prefix.'contents where status = "publish"');
        $result = $db->fetchRow($query);
        return array('count'=>$result['COUNT(*)']);
    }
    
    /**
     * 通过cid获取Content
     * @param $cid 文章id
     * @return array
     */
    function getContentByCid($cid)
    {
        $db= Typecho_Db::get();
        $query = $db->select('title','slug','text','created','modified')
                    ->from('table.contents')->where('cid = ?', $cid);
        $result = $db->fetchAll($query);
        return $result;
    }
    
    /**
     * 通过cid获取Content的简要信息
     * @param $cid 文章id
     * @return array
     */
    function getBriefContentByCid($cid)
    {
        $db= Typecho_Db::get();
        $query = $db->select('title','slug','commentsNum')
                    ->from('table.contents')->where('cid = ?', $cid);
        $result = $db->fetchAll($query);
        return $result;
    }
    
}