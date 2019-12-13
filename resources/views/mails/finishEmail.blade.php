<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Email finish form</title>
    <style type="text/css">
      /* ----- Custom Font Import ----- */
      @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
      /* ----- Text Styles ----- */
      table{
        font-family: 'Open Sans', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: antialiased;
        font-smoothing: antialiased;
      }
      @media only screen and (max-width: 700px){
        /* ----- Base styles ----- */
        .full-width-container{
          padding: 0 !important;
        }
        .container{
          width: 100% !important;
        }
        /* ----- Header ----- */
        .header td{
          padding: 30px 15px 30px 15px !important;
        }   
        /* ----- Hero subheader ----- */
        .hero-subheader__title{
          padding: 60px 15px 15px 15px !important;
          font-size: 30px !important;
        }
        .hero-subheader__content{
          padding: 20px 15px 70px 15px !important;
        }
      }
    </style>

    <!--[if gte mso 9]><xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml><![endif]-->
  </head>

  <body style="padding: 0; margin: 0;" bgcolor="#eeeeee">
    <span style="color:transparent !important; overflow:hidden !important; display:none !important; line-height:0px !important; height:0 !important; opacity:0 !important; visibility:hidden !important; width:0 !important; mso-hide:all;">This is your preheader text for this email (Read more about email preheaders here - https://goo.gl/e60hyK)</span>

    <!-- / Full width container -->
    <table class="full-width-container" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeee" style="width: 100%; height: 100%; padding: 30px 0 30px 0;">
      <tbody><tr>
        <td align="center" valign="top">
          <!-- / 700px container -->
          <table class="container" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff" style="width: 700px;">
            <tbody><tr>
              <td align="center" valign="top">
                <!-- / Header -->
                <table class="container header" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                  <tbody><tr>
                    <td style="padding: 30px 0 30px 0; border-bottom: solid 1px #eeeeee;" align="center">
                      <a href="" style="font-size: 30px; text-decoration: none; color: #000000;">
                        <img src="{{ asset('img/logo.png') }}" alt="Dumet School Logo" width="180">
                      </a>
                    </td>
                  </tr>
                </tbody></table>
                <!-- /// Header -->
                <!-- / Hero subheader -->
                <table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                  <tbody><tr>
                    <td class="hero-subheader__title" style="font-size: 33px;font-weight: bold;padding: 70px 10px 40px 10px;text-align: center;color: #58d2f5;" align="left">Thank you {{ $name }} for your interest in applying for the {{ $vacancy_name }} job in our company</td>
                  </tr>

                  <tr>
                    <td class="hero-subheader__content" style="font-size: 20px;line-height: 27px;color: #969696;padding: 20px 25px 60px 25px;text-align: center;" align="left">We will check your application and notify you again, if you are selected, good luck.</td>
                  </tr>
                </tbody></table>
                <!-- /// Hero subheader -->
                <!-- / Footer -->
                <table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
                  <tbody><tr>
                    <td align="center">
                      <table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-top: 1px solid #eeeeee; width: 620px;">
                        <tbody>
                        <tr>
                          <td style="color: #d5d5d5;text-align: center;font-size: 15px;padding: 15px 0 20px 0;line-height: 22px;">Copyright © {{date("Y")}} <a href="https://www.dumetschool.com/" target="_blank" style="text-decoration: none; border-bottom: 1px solid #d5d5d5; color: #d5d5d5;">Dumet School</a>. <br>All rights reserved.</td>
                        </tr>
                      </tbody></table>
                    </td>
                  </tr>
                </tbody></table>
                <!-- /// Footer -->
              </td>
            </tr>
          </tbody></table>
        </td>
      </tr>
    </tbody></table>
  </body>
</html>