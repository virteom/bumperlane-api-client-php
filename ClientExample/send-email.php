<?php
require_once('includes/on-each-page.php');

$api = \Virteom\ApiClient\Php\ApiClient::Create(\Virteom\ApiClient\Php\Api::CoreV2);
$request = $api->BuildRequest("ApplicationsApplicationDetail/API.Core.V2.API.Applications.Email");
$display = "No response";

if(!array_key_exists("to", $_REQUEST) || strlen(trim($_REQUEST["to"])) < 1){
    $display = "Please supply an email address to send to (on the previous page).";
}
else{
    $emailAddress = $_REQUEST["to"];
    $json = '{
    "Subject": "This is a test",
    "To": "' . $emailAddress . '",
    "From": "' . $emailAddress . '",
    "Body" : "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><title>DIY-IT: Top 10 how-to articles of 2016</title><link rel=\"stylesheet\" href=\"https://virteom.com\"><!--[if
    !mso]><!-- --><link href=\"https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800\" rel=\"stylesheet\"><!--<![endif]--><style type=\"text/css\">
            body {
                width: 100% !important;
                margin: 0 auto;
                padding: 0;
                -webkit-text-size-adjust: none;
                -ms-text-size-adjust: none;
            }
            * { /* disable Font Boosting on Android. */
                max-height: 999999em;
                -webkit-text-size-adjust: none;
            }
            table td {
                border-collapse: collapse;
            }
            #outlook a {
                padding: 0;
            } /* Force Outlook to provide a \"view in browser\" header link. */
            .ExternalClass * {
                line-height: 120%;
            } /* Fix for outlook.com changing the line-height */
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            a[href^=\"tel\"], a[href^=\"sms\"] {
                color: inherit;
                cursor: default;
                text-decoration: none;
            }

            @media only screen and (max-width: 640px) {
                *[class].hide {
                    display: block;
                    width: 0 !important;
                    max-height: 0 !important;
                    overflow: hidden !important;
                    display: none;
                }
                *[class].show {
                    display: block !important;
                    width: auto !important;
                    max-height: none !important;
                    overflow: visible !important;
                }
                *[class].inline {
                    display: inline !important;
                }
                *[class].block {
                    display: block !important;
                }
                *[class].floatleft {
                    float: left !important;
                }
                *[class].floatright {
                    float: right !important;
                }
                *[class].alignleft {
                    text-align: left !important;
                }
                *[class].aligncenter {
                    text-align: center !important;
                }
                *[class].alignright {
                    text-align: right !important;
                }
                *[class].clear {
                    clear: both;
                }
                *[class].stackonmobile {
                    display: block !important;
                    clear: both !important;
                    width: 100% !important;
                    margin: 0;
                }
                *[class].padtext {
                    padding: 10px;
                }
                *[class].fluid {
                    width: 100% !important;
                    height: auto !important;
                } /* for fluid layout */
                *[class].width160 {
                    width: 160px !important;
                }
                *[class].width270 {
                    width: 270px !important;
                } /* 25px margins */
                *[class].width280 {
                    width: 280px !important;
                } /* 20px margins */
                *[class].width300 {
                    width: 300px !important;
                } /* 10px margins */
                *[class].width320 {
                    width: 320px !important;
                }
                *[class].heightauto {
                    height: auto !important;
                }
                *[class].zeropad {
                    margin: 0 auto !important;
                    padding: 0px !important;
                }
                *[class].padbtm15 {
                    margin: 0 auto !important;
                    padding-bottom: 15px !important;
                }
                *[class].hdr {
                    height: auto !important;
                    width: 180px !important;
                    display: block !important;
                }
                *[class].hdrsocial {
                    height: auto !important;
                    width: 110px !important;
                }

            }
            </style></head><body>
        <span class=\"preheader\" style=\"display:none !important;font-size:1px;color:#F9F9F9;float:left;\">
           Hello
        </span>
    </body>
    </html>"}';
    $response = $request->Post($json);
    $display = $response->getBody();
}

echo $twig->render('send-email.html', array("data" => $display));