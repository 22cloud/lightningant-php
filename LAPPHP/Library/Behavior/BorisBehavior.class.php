<?php
// +----------------------------------------------------------------------
// | LAPPHP [ WE CAN DO IT JUST LAP IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://LAPphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Behavior;
use LAP\LAP;
/**
 * Boris行为扩展
 */
class BorisBehavior {
    public function run(&$params) {
        if(IS_CLI){
            if(!function_exists('pcntl_signal'))
                E("pcntl_signal not working.\nRepl mode based on Linux OS or PHP for OS X(http://php-osx.liip.ch/)\n");
            LAP::addMap(array(
                'Boris\Boris'               => VENDOR_PATH . 'Boris/Boris.php',
                'Boris\Config'              => VENDOR_PATH . 'Boris/Config.php',
                'Boris\CLIOptionsHandler'   => VENDOR_PATH . 'Boris/CLIOptionsHandler.php',
                'Boris\ColoredInspector'    => VENDOR_PATH . 'Boris/ColoredInspector.php',
                'Boris\DumpInspector'       => VENDOR_PATH . 'Boris/DumpInspector.php',
                'Boris\EvalWorker'          => VENDOR_PATH . 'Boris/EvalWorker.php',    
                'Boris\ExportInspector'     => VENDOR_PATH . 'Boris/ExportInspector.php',
                'Boris\Inspector'           => VENDOR_PATH . 'Boris/Inspector.php',
                'Boris\ReadlineClient'      => VENDOR_PATH . 'Boris/ReadlineClient.php',
                'Boris\ShallowParser'       => VENDOR_PATH . 'Boris/ShallowParser.php',
            ));
            $boris      =   new \Boris\Boris(">>> ");
            $config     =   new \Boris\Config();
            $config->apply($boris, true);
            $options    =   new \Boris\CLIOptionsHandler();
            $options->handle($boris);
            $boris->onStart(sprintf("echo 'REPL MODE FOR LAPPHP \nLAPPHP_VERSION: %s, PHP_VERSION: %s, BORIS_VERSION: %s\n';", LAP_VERSION, PHP_VERSION, $boris::VERSION));
            $boris->start();
        }
    }
}
