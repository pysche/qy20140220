<?php

class ErrorController extends Bc_Controller_Action_Weshop
{

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        $code = '200';
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
        
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = '这个页面不存在';
                $code = 404;
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = '服务器错误';
                $code = '500';
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->crit($this->view->message, $errors->exception);
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
                
        Bc_Log::getInstance()->error($errors->exception->getMessage()."\n".$errors->exception->getTraceAsString());

        $this->view->request   = $errors->request;
        $this->view->code = $code;

        if (APPLCATION_ENV=='production') {
            echo $this->view->render('error/fake.php');
            exit(0);
        }
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasPluginResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }


}

