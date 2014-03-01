<?php

/**
 * Main class witch manager all app
 * @author marco
 */
class albumVisualizer{
    /**
     * The patch of the directory where are stored photos
     * @var string
     */
    var $albumsRoot;
    /**
     * The patch where store thumbs, it should be writable
     * @var string
     */
    var $publicCache;
    /**
     * The directory where are stored template files
     * @var string
     */
    var $templateDir;
    
    /**
     * The directory where are stored smarty compiles
     * @var string
     */
    var $templateCompileDir;
    
    /**
     * The template engine class
     * @var object
     */
    var $smarty;
    
    /**
     * Load everything to diplay a page
     * @param array $q
     * @param string $albumsRoot
     * @param string $publicCache
     * @param string $templateCompileDir
     */
    function __construct($q, $albumsRoot, $publicCache, $templateDir, $templateCompileDir){
        /**
         * Configure global vars
         */
        $this->albumsRoot = $albumsRoot;
        $this->publicCache = $publicCache;
        $this->templateDir = $templateDir;
        $this->templateCompileDir = $templateCompileDir;
        
        /**
         * Configure smarty
         */
        $this->smarty = new Smarty();
        $this->smarty->template_dir = $this->templateDir;
        $this->smarty->compile_dir = $this->templateCompileDir;
        
        // The patch of the album or of the photo
        $p = $q;
        unset($p[0]);
        $p = implode('/', $p);
        
        switch($q[0]){
            case 'album':
                $album = $p;
                $this->albumView($album);
                break;
            case 'view':
                $photo = $p;
                $this->photoView($photo);
                break;
            default:
                $this->listView();
                break;
        }
    }
    
    /**
     * Get a list of file in a directory
     * @param string $patch
     * @return array
     */
    function getFilesList($patch){
        $fileList = array();
        if(is_dir($patch)){
            if($dh = opendir($patch)){
                while(($file = readdir($dh)) !== false){
                    $fileList[] = $file;
                }
                closedir($dh);
            }
        }
        $k = array_search('.', $fileList);
        unset($fileList[$k]);
        $k = array_search('..', $fileList);
        unset($fileList[$k]);
        return($fileList);
    }
    
    function getDirsList($patch){
        $dirList = array();
        $dirs = scandir($patch);
        foreach($dirs as $dir){
            if(is_dir($patch . '/' . $dir)){
                $dirList[] = $dir;
            }
        }
        $k = array_search('.', $dirList);
        unset($dirList[$k]);
        $k = array_search('..', $dirList);
        unset($dirList[$k]);
        return($dirList);
    }
    
    /**
     * Provide to load the album
     * @param string $p
     */
    function albumView($p){
        $tmphotos = $this->getFilesList(ROOT . '/albums/' . $p);
        
        $photos = array();
        $hphotos = array();
        
        /**
         * Get photo patch
         */
        foreach($tmphotos as $photo){
            $photos[] = ROOT . '/albums/' . $p . '/' . $photo;
        }
        foreach($tmphotos as $photo){
            $hphotos[] = URL . '/view/' . $p . '/' . $photo;
        }
        $this->smarty->assign('title', $p);
        $this->smarty->assign('photosPatch', $photos);
        $this->smarty->assign('phothosUrl', $hphotos);
        $this->smarty->display('album.tpl');
    }
    
    
    function photoView($p){
        $this->smarty->assign('title', $p);
        $this->smarty->assign('photoPatch', '/albums/' . $p);
        $this->smarty->display('view.tpl');
    }
    
    function listView(){
        $albums = array();
        $names = array();
        $dirs = $this->getDirsList(ROOT . '/albums/');
        foreach($dirs as $dir){
            $albums[] = URL . '/album/' . $dir;
            $names[] = $dir;
        }
        $this->smarty->assign('title', 'Albums');
        $this->smarty->assign('albums', $names);
        $this->smarty->assign('albumsUrl', $albums);
        $this->smarty->display('albums.tpl');
    }
}