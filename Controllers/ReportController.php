<?php
namespace Controllers;

use \Core\Controller;
use \Models\Report;
use \Helpers\RequestHelpers;

class ReportController extends Controller {

    public function index() {
        $resquestHelpers = new RequestHelpers();
        $resquestHelpers->redirectToPage();    
    }

    public function sendReport() {
        $data = array();
        $report = new Report();

        if($report->sendEmail()) {
            $data['msg'] = "successSendEmail";
        } else {
            $data['msg'] = "errorSendEmail";
        }

        echo json_encode($data);
    }

    public function verifyNotification() {
        $data = array();
        $report = new Report();

        $data['listOfNotifications'] = $report->getNotifications();
        $data['quantityNotifications'] = $report->getQuantitfyNotifications();
        
        echo json_encode($data);
    }

    public function readNotification() {
        $data = array();

        $report = new Report();

        if($report->readNotification()) {
            $data['msg'] = "success";
        } else {
            $data['msg'] = "error";
        }

        echo json_encode($data);
    }
}