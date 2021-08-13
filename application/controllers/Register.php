<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 01/12/2020
 * Time: 08:26
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH . 'PHPMailer/src/Exception.php';
require APPPATH . 'PHPMailer/src/PHPMailer.php';
require APPPATH . 'PHPMailer/src/SMTP.php';

class Register extends CI_Controller
{

    function index($referalkey = null)
    {

        $data['title'] = 'Register';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        $data['referalkey'] = $referalkey;
        //$this->load->view('templates/header', $data);
        $this->load->view('pages/register', $data);
        //$this->load->view('templates/footer');
    }


    function doregister()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('referalkey', 'Code de parainage', 'callback_referalkey_check');
        
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required');
        $this->form_validation->set_rules('telephone', 'Téléphone', 'required|min_length[10]|max_length[14]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[fiat_abonnes.email_abonne]', array(
            'is_unique' => 'L\'adresse mail saisie est déjà portée par un autre, s\'il s\'agit de vous alors nous vous demandons de vous connecter.'
        ));
        $this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[8]|max_length[50]');
        $this->form_validation->set_rules('passconfirm', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run()) {
            $this->saveData();
            //$this->sendMailForConfirmationAccount($this->input->post('email'));


            /*$array= array(
                'success'=>'<div class="alert-success p-3 text-lg-center"> Nous vous avons envoyé un mail à l\'adresse mail que vous venez d\'indiquer, prière de l\'ouvrir pour <strong>confirmer votre inscription</strong> !</div>
            '
            );*/

            $array= array(
                'success'=>'<div class="alert-success p-3 text-lg-center"> Merci pour votre inscription sur notre site. Vous pouvez vous <a href ="'.base_url('pages/connexion').'" >connecter Maintenant</a></strong> !</div>
            '
            );

            } else {
            $array = array(
                'error' => true,
                'referalkey_error' => form_error('referalkey'),
                'nom_error' => form_error('nom'),
                'prenom_error' => form_error('prenom'),
                'telephone_error' => form_error('telephone'),
                'email_error' => form_error('email'),
                'password_error' => form_error('password'),
                'passconfirm_error' => form_error('passconfirm')
            );

        }
        echo json_encode($array);

    }

    public function referalkey_check($result)
    {
        if ($_POST['referalkey'] != '') {

            $result = $this->register_model->referalkey_check($this->input->post('referalkey'));

            if ($result) {
                return true;
            } else {
                $this->form_validation->set_message('referalkey_check', 'Le code de parainage n\' a pas été reconnu');
                return FALSE;
            }
        }
    }

    public function check_password_caracter()
    {
        $password = $this->input->post('password');
        if (!preg_match("/^[a-zA-Z*#@$?0-9_-]{6,75}$/i", $password)) {
            $this->form_validation->set_message('check_password_caracter', "Le mot de passe doit contenir au moins une lettre Majuscule,
                 une lettre miniscule, un caractere special choisi parmi (*|#|@|$|?) et un chiffre de [0-9].");
            return false;
        } else {
            return true;
        }
    }

    public function sendMailForConfirmationAccount($email)
    {
        $annee_footer=date('Y');
        $from = $email;
        $mail = new PHPMailer(TRUE);

        $sendcode = md5(date('l jS \of F Y h A') . $email); 

        try {
            $mail->setFrom('commercial@fiatobtc.com', 'FiaToBTC');
            $mail->addAddress($from, 'FiaToBTC');
            $mail->Subject = "Confirmation du compte d'abonnement";
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
                              <td align="center" style="padding:0;Margin:0"> <h1 style="Margin:0;line-height:34px;font-family:helvetica,arial,verdana,sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#0a1e42">Bienvenu sur FiaToBTC</h1> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" height="15" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h2 style="Margin:0;line-height:22px;font-family:helvetica,arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#0a1e42">Confirmation de Votre Compte!</h2> </td> 
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
                  <td align="left" style="padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-top:25px"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td width="580" align="center" valign="top" style="padding:0;Margin:0"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                         <tbody><tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                            <img class="m_2067806560839729598adapt-img CToWUd a6T" src="https://www.fiatobtc.com/assets/img/email/FiatoBTcLogo.png" style="display:block;border:0;outline:none; background-color:#192a56; text-decoration:none" width="445" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 649.5px; top: 598px;"><div id=":10i" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Télécharger la pièce jointe " data-tooltip-class="a1V" data-tooltip="Télécharger"><div class="wkMEBb"><div class="aSK J-J5-Ji aYr"></div></div></div></div>
                          </td> 
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
                      <td align="left" class="m_2067806560839729598es-m-txt-l" style="padding:0;Margin:0"> <h3 style="Margin:0;line-height:22px;font-family:helvetica, arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#0a1e42">Cliquer sur un des boutons pour confirmer votre compte.</h3></td> 
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

          <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-content" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%"> 
           <tbody><tr style="border-collapse:collapse"> 
            <td align="center" style="padding:0;Margin:0"> 
             <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
               <tbody><tr style="border-collapse:collapse"> 
                <td align="left" style="padding:0;Margin:0;padding-left:30px;padding-right:30px;padding-bottom:40px"> 
                  
                 <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-left" align="left" style="border-collapse:collapse;border-spacing:0px;float:left"> 
                   <tbody><tr style="border-collapse:collapse"> 
                    <td width="243" class="m_2067806560839729598es-m-p0r m_2067806560839729598es-m-p20b" align="center" style="padding:0;Margin:0"> 
                     <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                       <tbody><tr style="border-collapse:collapse"> 
                        <td align="right" class="m_2067806560839729598es-m-txt-c" style="padding:0;Margin:0"> <span class="m_2067806560839729598es-button-border m_2067806560839729598es-button-border-1556820204000" style="border-style:solid;border-color:#2cb543;background:#4878ff;border-width:0px;display:inline-block;border-radius:5px;width:auto"> <a class="m_2067806560839729598es-button" style="text-decoration:none;font-family:helvetica,arial,verdana,sans-serif;font-size:16px;color:#ffffff;border-style:solid;border-color:#4878ff;border-width:12px 30px;display:inline-block;background:#4878ff;border-radius:5px;font-weight:bold;font-style:normal;line-height:19px;width:auto;text-align:center" href="' . base_url('register/confirmAcount/' . $sendcode) . '" rel="noopener noreferrer" target="_blank" data-saferedirecturl="' . base_url('register/confirmAcount/' . $sendcode) . '">Valider Compte</a> </span> </td> 
                       </tr> 
                     </tbody></table> </td> 
                    <td class="m_2067806560839729598es-hidden" width="5" style="padding:0;Margin:0"></td> 
                   </tr> 
                 </tbody></table> 
                  
                 <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-left" align="left" style="border-collapse:collapse;border-spacing:0px;float:left"> 
                   <tbody><tr style="border-collapse:collapse"> 
                    <td width="39" class="m_2067806560839729598es-m-p20b" align="center" style="padding:0;Margin:0"> 
                     <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                       <tbody><tr style="border-collapse:collapse"> 
                        <td align="center" style="padding:0;Margin:0;padding-top:10px"> <p style="Margin:0;font-size:14px;font-family:helvetica,arial,verdana,sans-serif;line-height:21px;color:#0a1e42">ou</p> </td> 
                       </tr> 
                     </tbody></table> </td> 
                   </tr> 
                 </tbody></table> 
                  
                 <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-right" align="right" style="border-collapse:collapse;border-spacing:0px;float:right"> 
                   <tbody><tr style="border-collapse:collapse"> 
                    <td width="248" align="center" style="padding:0;Margin:0"> 
                     <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                       <tbody><tr style="border-collapse:collapse"> 
                        <td align="left" class="m_2067806560839729598es-m-txt-c" style="padding:0;Margin:0"> <span class="m_2067806560839729598es-button-border m_2067806560839729598es-button-border-1556820227073" style="border-style:solid;border-color:#2cb543;background:#4878ff;border-width:0px;display:inline-block;border-radius:5px;width:auto">
                          <a class="m_2067806560839729598es-button" style="text-decoration:none;font-family:helvetica,arial,verdana,sans-serif;font-size:16px;color:#ffffff;border-style:solid;border-color:#4878ff;border-width:12px 30px;display:inline-block;background:#4878ff;border-radius:5px;font-weight:bold;font-style:normal;line-height:19px;width:auto;text-align:center" href="' . base_url('register/confirmAcount/' . $sendcode) . '" rel="noopener noreferrer" target="_blank" data-saferedirecturl="' . base_url('register/confirmAcount/' . $sendcode) . '">Confirmer Inscription</a> </span>
                           </td> 
                       </tr> 
                     </tbody></table> </td> 
                   </tr> 
                 </tbody></table> 
                 </td> 
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
            $mail->Username = 'commercial@fiatobtc.com';
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
                $this->saveData();
            }

        } catch (Exception $e) {
            //return $redirect;
            echo '<h1 class="alert alert-danger text-center">Impossible d\'envoyer le message</h1>';
            echo $e->errorMessage();
        }

    }

    function saveData()
    {
        $initial_code = "0123456789";
        $referal_key_abonne = substr(str_shuffle(str_repeat($initial_code, mt_rand(5, 20))), 0, 5);
        $email = $this->input->post('email');
        $sendcode = md5(date('l jS \of F Y h A') . $email);
        if (!$this->input->post('referalkey')) {
            $referalkey_parain = 'FiaToBTC029202829672CDOUG';
        } else {
            $referalkey_parain = $this->input->post('referalkey');
        }
        $data = array(
            'prenom_abonne' => htmlspecialchars($this->input->post('prenom')),
            'nom_abonne' => htmlspecialchars($this->input->post('nom')),
            'email_abonne' => htmlspecialchars($this->input->post('email')),
            'telephone_abonne' => htmlspecialchars($this->input->post('telephone')),
            'mot_de_passe_abonne' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'referal_key_abonne' => $referal_key_abonne,
            'referal_key_parain' => $referalkey_parain,
            'validation_code' => $sendcode,
            'statut_abonne' =>'online', // A enlever une fois les systeme de mails fonctionne
            'date_envoi' => date('Y-m-d')
        );
        $this->register_model->save_data_account($data);
    }

    function generate_referal_key()
    {
        $initial_code = "0123456789";
        $referal_key_abonne = substr(str_shuffle(str_repeat($initial_code, mt_rand(5, 20))), 0, 5);
        return $referal_key_abonne;
    }

    public function confirmAcount($code)
    {
        $data['abonne'] = $this->register_model->check_code_validation($code);
        if ($data['abonne']) {
            $this->register_model->confirm_account($code);
            redirect(base_url('login/loginBycodeConfirm/' . $code));

        } else {
            $this->session->set_flashdata('connexion_failed', 'Impossible de confirmer l\'inscription, code expiré !');
            redirect(base_url('pages/connexion'));
        }
    }

    function loadNotification()
    {
        if ($_POST["view"] != '') {

            $data = array('statut_view' => 1);
            $this->register_model->updateNotification($data);
        }

        //NOTIFICATIONS D'ACHAT
        $result = $this->register_model->fetchAllnotifications();
        $output = '';


        if ($result) {
            foreach ($result as $row) {
                $output .= '
            <div class="dropdown-divider"></div>      
              <a href="' . site_url('register/datails/' . $row->referal_key_abonne) . '" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i>1 inscription
                  <span class="float-right text-muted text-sm"> ' . substr($row->created_at, 5, 11) . '</span>
              </a>
              
            ';
            }
            $output .= '
            <div class="dropdown-divider"></div>
              <a href="' . site_url('register/fetchAbonnes') . '" class="dropdown-item dropdown-footer">Voir toutes les Notifications</a>
        ';
        } else {
            $output .= '
            <div class="dropdown-divider"></div>      
              <a href="#" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i>Aucune notification
                  <span class="float-right text-muted text-sm"> ' . date('Y-m-d') . '</span>
             </a>
         ';
        }

        //$query_1 = "SELECT * FROM comments WHERE comment_status=0";
        //$result_1 = mysqli_query($connect, $query_1);
        $result_1 = $this->register_model->fetchUnseenNotifications();
        $count = $result_1; //mysqli_num_rows($result_1);
        $data = array(
            'notification' => $output,
            'unseen_notification' => $count
        );
        echo json_encode($data);
    }


    //Fonctions d'administration abonnés
    function fetchAbonnes()
    {
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {

            redirect(base_url('pages/connexion'));

        } else {

            $data['title'] = 'Abonnés';
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            $data['subscribes'] = $this->register_model->fetchAbonnes();
            $data['news'] = $this->register_model->fetchUnseenNotifications();
            $data['confirmes'] = $this->register_model->fetchConfirm();
            $data['nonconfirm'] = $this->register_model->fetchNonConfirm();
            $data['total'] = $this->register_model->fetchTotal();

            $this->load->view('templates/header', $data);
            $this->load->view('abonnes/index', $data);
            $this->load->view('templates/footer');
        }

    }

    function datails($referalkey)
    {

        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

            $data['title'] = 'Abonnements | Détails';
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            //Recupération du taux d'achat
            $data['subscribe'] = $this->register_model->datailsAbonne($referalkey);
            $data['allsubscibes'] = $this->register_model->datailsAllSubscribes($referalkey);

            $this->load->view('templates/header', $data);
            $this->load->view('abonnes/details', $data);
            $this->load->view('templates/footer');
        }
    }

    function check()
    {
        $id = 'erickbanze@gmail.com';
        var_dump(md5(date('l jS \of F Y h A') . $id));
    }

    function myaccount()
    {

        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        $data['mailabonne']=$this->sales_model->get_email_abonne($session_data['id_abonne']);//Recupération de l'email de l'abonné pour s'en servir comme identifiant lors de l'affichage de ses ventes effectuées.
        $key_abonne=$data['mailabonne']['referal_key_abonne'];
        $email = $data['mailabonne']['email_abonne'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {


            $data['title'] = 'Mon compte | ' . ucfirst($data['role_utilisateur']);
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            //Recupération du taux d'achat
            $data['mydata'] = $this->register_model->myaccount($data['id_abonne']);
            $referalkey = $data['mydata']['referal_key_abonne'];
            //Les commandes d'achats d'un utilisateurs
            $data['buyingcommands']= $this->buying_model->showUserBuyingCommands($session_data['id_abonne']);

            $data['fiels'] = $this->register_model->myfiels($referalkey);
            $data['nb_fiels'] = $this->register_model->countmyfiels($referalkey);
            $data['bonus']= $this->buying_model->getClienBonus($key_abonne);
            $data['sales']= $this->sales_model->getClientVentes($email);
            $data['total_sales']=$this->sales_model->get_total_sales($email);//Total de vente
            $data['total_buying']= $this->buying_model->get_total_buying($session_data['id_abonne']); //Total des achats

            //Primes de fidélité
            $data['primes']=$this->buying_model->getClientFidelity($email);

            $this->load->view('templates/header', $data);
            $this->load->view('abonnes/myaccount', $data);
            $this->load->view('templates/footer');
        }
    }
    function updateAccount(){

       $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

          if (isset($_FILES["photo_abonne"]["name"])) {

            $config['upload_path'] = './assets/img/users';
            $config['allowed_types'] = 'jpg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photo_abonne')) {
                $file = 'noimage.png';
            } else {
                $string = $_FILES["photo_abonne"]["name"];
                $pattern = '# #';
                $replacement = "_";
                $data = $this->upload->data();
                $file = preg_replace($pattern, $replacement, $string);
            }

        $data= array(
          'pays_origine' => htmlentities($this->input->post('pays_origine')),
          'ville_abonne' => htmlentities($this->input->post('ville_abonne')),
          'adresse' => htmlentities($this->input->post('adresse')),
          'photo_abonne'=>$file,
          'updated_at' => date('Y-m-d')
        );
        $this->register_model->updateinfoaccount($data, $session_data['id_abonne']);
        $this->form_validation->set_message('account_updated', 'Le compte a été mises à jour');
        redirect(base_url('register/myaccount'));
      }
    }
    
  }

    function changePassword(){
        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('ancient_password', 'Ancien mot de passe', 'required|callback_check_ancient_password');

        $this->form_validation->set_rules('new_password', 'Mot de passe', 'required|min_length[8]|max_length[50]');
        $this->form_validation->set_rules('confirm_new_password', 'Confirmer le nouveau de passe', 'required|matches[new_password]');

        if ($this->form_validation->run()) {
            $data = array(
                'mot_de_passe_abonne' => password_hash($this->input->post('new_password'), PASSWORD_BCRYPT)
            );
            $this->register_model->changePassword($data, $session_data['id_abonne']);

            $array= array(
                'success'=>'<div class="alert-success p-3 text-lg-center"> Votre mot de passe a été changé avec succès!</div>
            '
            );

          }else {
            $array = array(
                'error' => true,
                'ancient_password_error' => form_error('ancient_password'),
                'new_password_error' => form_error('new_password'),
                'confirm_new_password_error' => form_error('confirm_new_password')
            );
        }
        echo json_encode($array);
    }
  }
    function check_ancient_password($result){
      $session_data = $this->session->userdata('fiato_logged_in');
      $result = $this->register_model->check_ancient_password($session_data['id_abonne'], $this->input->post('ancient_password'));
      if ($result) {
          return TRUE;
      } else {
          $this->form_validation->set_message('check_ancient_password', 'L\'ancien mot de passe saisi n\'est pas correct');
          return FALSE;
      }
  }

    function terms(){
    $this->load->view('pages/terms');
  }
}