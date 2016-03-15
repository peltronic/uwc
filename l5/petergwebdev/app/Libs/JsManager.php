<?php
namespace App\Libs;

class JsManager {
    protected $_libPaths;
    protected $_inlinePaths;

    public function __construct($inlinePaths=[],$libPaths=[])
    {
        // NOTE: these are arrays, default to empty arrays
        $this->_libPaths = $libPaths;
        $this->_inlinePaths = $inlinePaths;
    }

    public function pushLib($fileObj)
    {
        if ( is_array($fileObj) ) {
            $type = $fileObj['type'];
            $file = $fileObj['file'];
        } else {
            $type = 'js';
            $file = $fileObj;
        }
        if ( (substr($file,0,1)!="/") && !strstr($file,"//") ) {
            $file = "/".$file;
        }
        //$this->_libPaths[] = $file;
        $this->_libPaths[] = ['type'=>$type,'file'=>$file];
    }

    public function pushInline($fileObj)
    {
        if ( is_array($fileObj) ) {
            $type = $fileObj['type'];
            $file = $fileObj['file'];
        } else {
            $type = 'js';
            $file = $fileObj;
        }
        if ( (substr($file,0,1)!="/") && !strstr($file,"//") ) {
            $file = "/".$file;
        }
        $this->_inlinePaths[] = ['type'=>$type,'file'=>$file];
    }

    public function renderLibs()
    {
		$html = '';
		foreach ($this->_libPaths as $fileObj) {
            if ( is_array($fileObj) ) {
                $type = $fileObj['type'];
                $file = $fileObj['file'];
            } else {
                $type = 'js';
                $file = $fileObj;
            }
			$isLocal = (strstr($file,'//') ? 0 : 1);
            if ($isLocal and !file_exists(public_path().$file)) {
                continue; // local and not updated (? PSG) (or doesn't actually exist)
            }
            if ( defined('IS_THROTTLING_DISABLED') && IS_THROTTLING_DISABLED ) {
			    $html .= '<script type="application/javascript" src="'.$file.'"></script>'."\n";
            } else {
			    $time = ($isLocal ? filemtime(public_path().$file) : NULL);
			    $html .= '<script type="application/javascript" src="'.$file.($time ? "?".$time : "").'"></script>'."\n";
            }
		}
		
        return $html;
    } // render()

    public function renderInlines()
    {
		$html = '';
		foreach ($this->_inlinePaths as $fileObj) {
            if ( is_array($fileObj) ) {
                $type = $fileObj['type'];
                $file = $fileObj['file'];
            } else {
                $type = 'js';
                $file = $fileObj;
            }
			$isLocal = (strstr($file,'//') ? 0 : 1);
            if ($isLocal and !file_exists(public_path().$file)) {
                continue; // local and not updated (? PSG) (or doesn't actually exist : %FIXME -- throw exception?)
            }
            $scriptType = ($type=='jsx') ? 'text/jsx;harmony=true' : 'application/javascript';
            if ( defined('IS_THROTTLING_DISABLED') && IS_THROTTLING_DISABLED ) {
			    $html .= '<script type="'.$scriptType.'" src="'.$file.'"></script>'."\n";
            } else {
			    $time = ($isLocal ? filemtime(public_path().$file) : NULL);
			    $html .= '<script type="'.$scriptType.'" src="'.$file.($time ? "?".$time : "").'"></script>'."\n";
            }
		}
		
        return $html;
    } // render()
    
    public function minify($c = NULL) {                    
        // tbd
	}
}
