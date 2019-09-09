<?php
namespace Models;

use \Core\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Report extends Model {

    private function salesOfTheDay() {
        global $currentDate;
        $array = array();

        $sql ="SELECT 
                COUNT(sales.id) as quantitySells,
                SUM(sales.sale_price) as total,
                sales.id,
                sales.id_seller, 
                sellers.name, 
                sellers.email, 
                sales.commission, 
                sales.sale_price,
                sales.date_sale
                FROM sellers
                INNER JOIN sales ON sellers.id = sales.id_seller
                WHERE sales.disableStatus = 0 AND
                DAY(date_sale) = DAY(:currentDate)";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":currentDate", $currentDate);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    private function createNotificationReport() {
        global $currentDate;
        $sql = "INSERT INTO notification (title, date_notify, link) VALUES
                (:title, :date_notify, :link)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":title", "Você tem um novo relatório enviado");
        $sql->bindValue(":date_notify", $currentDate);
        $sql->bindValue(":link", "https://mailtrap.io");
        $sql->execute();

        return true;
    }

    public function readNotification() {
        $sql = "UPDATE notification SET read_notify = 1";
        $sql = $this->db->query($sql);
        $sql->execute();

        return true;
    }

    public function getNotifications() {
        $array = array();

        $sql = "SELECT id, 
                title, 
                DATE_FORMAT(date_notify, '%d/%m/%Y %H:%i') as date_notify, 
                link 
                FROM notification";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getQuantitfyNotifications() {
        $array = array() ;
        $quantityNotifications = 0;

        $sql = "SELECT COUNT(id) as quantityNotifications FROM notification WHERE read_notify = 0";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $quantityNotifications = $array['quantityNotifications'];
        }

        return $quantityNotifications;
    }


    public function sendEmail() {
        $mail = new PHPMailer(true);
        $listSells = $this->salesOfTheDay();

        try {
            //Server settings
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '7ab80bb726afe5';                     // SMTP username
            $mail->Password   = '87ed0b38a4f7b6';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;   
                                             // TCP port to connect to
        
            //Recipients
            $mail->setFrom('manager@example.com', 'Mailer');
            $mail->addAddress('admin@example.net', 'Admin system sells');     // Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Relátorio de Vendas';
            $mail->Body = "<h1 style='color:#a1afee;'>Dia: ".date("d/m/Y H:i", time())." </h1><br/>";
            foreach($listSells as $items) {
                $mail->Body .= "<h2>Quantidade de vendas de Hoje: <span style='color:#a1afee;'>".$items['quantitySells']."</span><br/></h2>";
                $mail->Body .= "<h2>Valor total: <span style='color:#79c28f;'>R$".number_format($items['total'], 2, ",", ".")."</span><br/>";
            }
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            $this->createNotificationReport();
            return true;

        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

    }

}