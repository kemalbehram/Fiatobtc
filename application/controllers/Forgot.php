<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 01/12/2020
 * Time: 09:02
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH . 'PHPMailer/src/Exception.php';
require APPPATH . 'PHPMailer/src/PHPMailer.php';
require APPPATH . 'PHPMailer/src/SMTP.php';

class Forgot extends CI_Controller{
    function index(){
        $data['title'] = 'Forgot-password';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        //$this->load->view('templates/header', $data);
        $this->load->view('pages/forgot-password', $data);
        //$this->load->view('templates/footer');
    }

    function checkEmail(){
       $email= $this->input->post('email');
        $result= $this->forgot_model->checkEmail($email);
        if ($result) {

            $this->forgotPassword($email);
            $this->session->set_flashdata('email_sent', 'Nous avons envoyé un mail à l\'adresse indiquée, veuillez le consulter pour Réinitialiser le mot de passe');
            redirect(base_url('forgot'));
        }else{
            $this->session->set_flashdata('email_notfound', 'Nous n\'avons pas reconnu votre adresse mail, rassurez-vous que vous êtes déjà inscrit sur notre plateforme !');
            redirect(base_url('forgot'));
        }

        
    }


    public function forgotPassword($email)
    {
        $from = $email;
        $mail = new PHPMailer(TRUE);

        $sendcode = md5($email); 

        try {
            $mail->setFrom('support@fiatobtc.com', 'FiaToBTC');
            $mail->addAddress($from, 'FiaToBTC');
            $mail->Subject = "Mot de passe oublié";
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Body = '
              
                      <body style="background-color: #F2F6FA;">
               <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-content" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td align="center" style="padding:0;Margin:0"> 
                   <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                         <tbody><tr style="border-collapse:collapse"> 
                          <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                           <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                             <tbody><tr style="border-collapse:collapse"> 
                              <td align="center" height="30" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h1 style="Margin:0;line-height:34px;font-family:helvetica,arial,verdana,sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#0a1e42">Vous avez oublié votre mot de passe</h1> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" height="15" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h2 style="Margin:0;line-height:22px;font-family:helvetica,arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#0a1e42">Nous vous aidons à le récupérer !</h2> </td> 
                             </tr> 
                           </tbody></table> </td> 
                         </tr> 
                       </tbody></table> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody>
              </table>

           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-content" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%"> 
            <tbody><tr style="border-collapse:collapse"> 
            <td align="center" style="padding:0;Margin:0"> 
           <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td align="center" style="padding:0;Margin:0;padding-left:30px;padding-right:30px"> 
               <table cellpadding="0" cellspacing="0" width="95%" style="border-collapse:collapse;border-spacing:0px"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" class="m_2067806560839729598es-m-txt-l" style="padding:0;Margin:0"> <h3 style="Margin:0;line-height:22px;font-family:helvetica, arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#0a1e42; text-align:center"><a  href="'. base_url('recover/index/' . $sendcode) .'" rel="noopener noreferrer" target="_blank" data-saferedirecturl="'. base_url('recover/index/' . $sendcode) .'">Cliquer sur ce lien pour réinitialiser votre mot de passe</a>.</h3></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr>
                     <tr style="border-collapse:collapse"> 
                      
                     </tr>
                     <tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody></table> </td> 
             </tr> 
           </tbody></table> </td> 
            </tr> 
            </tbody>
          </table>


           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-footer" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td align="center" style="padding:0;Margin:0"> 
               <table bgcolor="#ffffff" class="m_2067806560839729598es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff;border-top:1px solid #ededed"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td align="left" style="Margin:0;padding-left:30px;padding-right:30px;padding-top:40px;padding-bottom:40px"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                         <tbody>
                          <tr style="border-collapse:collapse"> 
                          <td align="center" class="m_2067806560839729598es-m-txt-c" style="padding:0;Margin:0;padding-bottom:10px"> <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://www.fiatobtc.com/assets/img/email/email-footer.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" width="170" class="CToWUd"> </a> </td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0;padding-bottom:10px"> <p style="Margin:0;font-size:11px;font-family:helvetica,arial,verdana,sans-serif;line-height:17px;color:#999999"><a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="'.base_url('buying').'" target="">Acheter</a>&nbsp; |&nbsp;&nbsp;<a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="'.base_url('sales').'" target="_blank" data-saferedirecturl="#">Vendre</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Echanger</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Contact</a></p></td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-table-not-adapt m_2067806560839729598es-social" style="border-collapse:collapse;border-spacing:0px"> 
                             <tbody><tr style="border-collapse:collapse"> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica, arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci3.googleusercontent.com/proxy/hU2WzS2PyDWPBFnYX3wH7ML_NrKyiQ2Ea000M3Mi-Zc3mFsMYY8-QZa_eZMQnXb_i_0xgC49zbMvDjjWMYl42n1Asjgxo-w2vEcLHOimyF4nLbtPE1AcvloKLTuTneQToe3IzF1xZby0CGGwAoI56OAPJWMdvzwb43y4dKDf4H1ORLm9RyV8KtQfdS6PmavW2JQhMb9KnL2Zvc_jzvLRxm1fm1QThWcTy45uNSNV4xcWkfPxhoNUJQWPPh3m4kw1f6A-LXjP14SMHLscHkpjaTMI4-0=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/a536842e94841fd7412b8cf4f4731af10bbd1728c2dea2c0c69f9e96cd0b8f83684373abcadf56c360f1022af9e5c90dacade8c23f97e365a709ac439221ecf3.png" alt="Fb" title="Facebook" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a>
                                 </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/VYOI-U6ViNREkrtUvidwYPRoLOa_GsrJocGSEp6qHWku-EQ-A46FRLOo5yO3kfT_y2zW6WMJ4YYW1Xe13XqOPt2OQCfXjPE9ZvwSD8mN8o9g0H92b2gWmzmcpt_NdblhQH1VJMtD1T_dS5ecH5fv5AiHhVPHPMU_QL5O43vFjX4wqRvFdbKkAJcqlvLbB2_rtQcVhyq2eJwWbX4s6VcqXhX3qbcXKWg6TKgIXnyppQ7iND6MYC-JyeOasDoZz1Y5Nl4DAyn0utQT12cyMep5KaqrLHo=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/d1ef1d7022812086f5dcd594d61ad4b2c2f41dc0a3367f5f7e16867a8f20f5fbc4a4bafdce8b758af56dfd72fb7881ce1d8ad35a3e2c1d99287d1274917fec56.png" alt="Tw" title="Twitter" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica, arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/CfeF3RygsLZ4U4u2UQNe7mmjrAfW2jVzwBUQeweDh9fVr7M9-KCgY5w6mCnFKzKu6ob8AkuK3i7Bh24Ou8R6nV9ZXQfPqyF_5CvQ3OYwj-A2v-u6Omx9qfWQ2RMm4JQ7GQOmFA8ieVSx_ZiWcTO5koW_uCgHBrOdkOQc1YftO9GcTXr_HJPP9ULpFn9DE8Hxt_Y4T1cveQHXpmc2eNU-5YfaG6uCOrXfFODURvcneQcj7UqMC8XnCXVHJlxwAvkEhyLkgRMNTfDZbcz_0RaRcFIslx8=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/ee1eb3291f900f3928ea59e49405e7f89d56db76b9de001644f9defe70017f79a2190f68ab836e4faaab74b67ca71e01b5dfa3781bfffd6fb9797c3946e7a691.png" alt="In" title="Linkedin" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci6.googleusercontent.com/proxy/nJvfVVdkDB4Hnwn3K59cZRWKGL3rDwxMEIoCOEUBrNZLGRyOSIgmOiv3pAYj-6uUypDV6irC1SivaIz2sjJia1HCtTKKNzViEzbAIouK4VhUgdxFwCBNr94f2qeGPsNUkIvDTkW874zZHXhMjp9yhv9jp8ISzMcfdsJTvceQRUK-NakFHidRWg3gdvdObfZH6I48NJYlC5apUnYv_bj2nW91ZBhqABsLA3ei2md5CMZfgnrL6g-tcpR9mFYHnK_LOpH1HmTc6WnZQjQrD1l7HQpFAhg=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/fe425a4fe6a7943b516ac86118be7087e81728d9449930e8e0b1ed8fcd7d0513dc833e4a4d8fc53bfa59d326d94caea884e43f253285b48d9c858c8bb3073e96.png" alt="Telegram" title="Telegram" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0"> 
                                <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/uegN1XsIbnaB9tQujjyxSUFUnRqkhEOX1w7WyLszOFnl1WNPWvMgPLv08-0XcPebZAIqBpSv6iW9ft5i7DwZWP4cnP6cCmlwqGuo3a9Xa9VnHGXoeTahDXcM5AKOnKMpgMuZeHDROFKUPx1kdTg3LX9jKgKfy7jlTrWzMkyi64BdtqBzmbKVFrQY4-egW9T3DORGZyx32EYTxDfBirLswg9hWvCI-ol0THpmznyzuQjZC_hs0RX0MuPixlRHwpxzBO7hZbSpi1kzAJTOjlYwdYIflew=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/f868f23585d96b50efb6708d1a1ebc80ee5a7c19da2e86054bbf9f9355e9b7bdff683cbf72ee54601151562cdcd75cbf7e72e6e17a2030b7572a6b4a390bc41f.png" alt="Ig" title="Instagram" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                             </tr> 
                           </tbody></table> </td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0;padding-top:15px"> <p style="Margin:0;font-size:10px;font-family:helvetica,arial,verdana,sans-serif;line-height:15px;color:#999999">© '.$annee_footer.' FiaToBTC. Tous droits réservés.</p></td> 
                         </tr> 
                       </tbody></table> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody></table> </td> 
             </tr> 
           </tbody>
          </table>
                ';
            $mail->isSMTP();
            $mail->Host = 'mail.fiatobtc.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'smtp';
            $mail->Username = 'support@fiatobtc.com';
            $mail->Password = 'FIATO@2btc';
            $mail->Port = 587;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            if (!$mail->send()) {
                echo '<h1 class="alert alert-danger text-center">Message Error : </h1>' . $mail->ErrorInfo;
            } else {
                //echo '<h1 class="alert alert-success text-center">Message has been sent</h1>';
                $this->saveRecuperationCode();
            }

        } catch (Exception $e) {
            //return $redirect;
            echo '<h1 class="alert alert-danger text-center">Impossible d\'envoyer le message</h1>';
            echo $e->errorMessage();
        }

    }


    function saveRecuperationCode(){
        $email= $this->input->post('email');
        $data = array('recuperationCode'=>md5($email));
        $this->forgot_model->saveRecuperationCode($data, $email);
    }
}

