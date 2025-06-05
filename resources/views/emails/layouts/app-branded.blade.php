<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <style>
          body {
            font-family: Helvetica;
            font-size: 16px;
            line-height: 24px;
            color: #393939;
            background-color: #d4d8df;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
          }
          a {
            color: #263d5e;
          }
          #emailFooter {
            margin: 30px auto 50px auto;
            max-width: 800px;
          }
          .box-ride {
              font-size: 12px;
              border-bottom: 1px solid #ccc;
              margin: 20px 0;
          }
          .grid {
              box-sizing: border-box;
              display: flex;
              margin-left: auto;
              margin-right: auto;
              flex-wrap: wrap;
              max-width: 1400px;
              width: 88.5714285714%;
              margin-bottom: 20px;
          }
          .col-desk-1 {
              box-sizing: border-box;
              width: 8.3333333333%;
              padding-right: 3.2258064516%;
          }
          .col-desk-2 {
              box-sizing: border-box;
              width: 16.6666666667%;
              padding-right: 3.2258064516%;
          }
          .col-desk-3 {
              box-sizing: border-box;
              width: 25%;
              padding-right: 3.2258064516%;
          }
          .col-desk-4 {
              box-sizing: border-box;
              width: 33.3333333333%;
              padding-right: 3.2258064516%;
          }
          .col-desk-5 {
              box-sizing: border-box;
              width: 41.6666666667%;
              padding-right: 3.2258064516%;
          }
          .col-desk-6 {
              box-sizing: border-box;
              width: 50%;
              padding-right: 3.2258064516%;
          }
          .col-desk-7 {
              box-sizing: border-box;
              width: 58.3333333333%;
              padding-right: 3.2258064516%;
          }
          .col-desk-8 {
              box-sizing: border-box;
              width: 66.6666666667%;
              padding-right: 3.2258064516%;
          }
          .col-desk-9 {
              box-sizing: border-box;
              width: 75%;
              padding-right: 3.2258064516%;
          }
          .col-desk-10 {
              box-sizing: border-box;
              width: 83.3333333333%;
              padding-right: 3.2258064516%;
          }
          .col-desk-11 {
              box-sizing: border-box;
              width: 91.6666666667%;
              padding-right: 3.2258064516%;
          }
          .col-desk-12 {
              box-sizing: border-box;
              width: 100%;
              padding-right: 3.2258064516%;
          }
          .msg-img {
              display: none;
          }
        </style>
    </head>
    <body>
        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" align="center" style="width: 80%; margin: 10px 10%; text-align: center;" >
          <tr>
              <td align="center" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailContainer" style="text-align: center;" >
                      <tr>
                          <td align="center" valign="top">
                              <table border="0" id="emailHeader">
                                  <tr>
                                      <td align="center" valign="top">
                                          <a href="https://smart-mobility.be"><img src="{{asset('/images/common/logo.png')}}" class="logo" width="133" alt="" border="0" /></a>
                                      </td>
                                  </tr>
                              </table>
                          </td>
                      </tr>

                      @yield('content')

                      <tr>
                          <td align="center" valign="top">
                              <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailFooter">
                                  <tr>
                                      <td  valign="top" style="font-size:15px; line-height: 13px; text-align:center;">
                                          <a style="color:#1B8C63;" href="https://ecomobilis.be">Ecomobilis.be</a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="font-size:12px; line-height: 13px; text-align:center;">
                                          XXXX
                                          Street nr
                                          Address tbc
                                      </td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
              </td>
          </tr>
      </table>
    </body>
</html>
