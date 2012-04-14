<?php

function GetRebill()
{
 
	$objRebill = new RebillPayment();


        $objRebill->CustomerRef($_POST['txtCustomerRef']);

        $objRebill->CustomerTitle($_POST['txtTitle']);

        $objRebill->CustomerFirstName($_POST['txtFirstName']);

        $objRebill->CustomerLastName($_POST['txtLastName']);

        $objRebill->CustomerCompany($_POST['txtCompany']);

        $objRebill->CustomerJobDesc($_POST['txtPosition']);

        $objRebill->CustomerEmail($_POST['txtEmail']);

        $objRebill->CustomerAddress($_POST['txtAddress']);

        $objRebill->CustomerSuburb($_POST['txtSuburb']);

        $objRebill->CustomerState($_POST['txtState']);

        $objRebill->CustomerPostCode($_POST['txtPostCode']);

        $objRebill->CustomerCountry($_POST['txtCountry']);

        $objRebill->CustomerPhone1($_POST['txtPhone1']);

        $objRebill->CustomerPhone2($_POST['txtPhone2']);

        $objRebill->CustomerFax($_POST['txtFax']);

        $objRebill->CustomerURL($_POST['txtURL']);

        $objRebill->CustomerComments($_POST['txtComments']);

        $objRebill->RebillInvRef($_POST['txtInvRef']);

        $objRebill->RebillInvDesc($_POST['txtInvDesc']);

        $objRebill->RebillCCName($_POST['txtCCName']);

        $objRebill->RebillCCNumber($_POST['txtCCNumber']);

        $objRebill->RebillInitAmt($_POST['txtInitAmt']);

        $objRebill->RebillInitDate($_POST['txtInitDate']);

        $objRebill->RebillRecurAmt($_POST['txtRecurAmt']);

        $objRebill->RebillStartDate($_POST['txtRecurDate']);

        $objRebill->RebillEndDate($_POST['txtEndDate']);

        $objRebill->eWAYCustomerID($_POST['txtewayCustomerID']);

        $objRebill->RebillCCExpMonth($_POST['drpExpMonth']);

        $objRebill->RebillCCExpYear($_POST['drpExpYear']);

        $objRebill->RebillInterval($_POST['txtInterval']);

        $objRebill->RebillIntervalType($_POST['drpInterval']);



        return $objRebill;

}

function InitialiseFields()
{
 	global $txtCustomerRef, $txtTitle, $txtFirstName, $txtLastName, $txtCompany, $txtPosition, $txtEmail, $txtFax;
	global $txtAddress, $txtSuburb, $txtState, $txtPostCode, $txtCountry, $txtPhone1, $txtPhone2, $txtURL, $txtComments;
	global $txtInvRef, $txtInvDesc, $txtCCName, $txtCCNumber, $txtInitAmt, $txtInitDate, $txtRecurAmt, $txtRecurDate; 
	global $txtEndDate, $txtewayCustomerID, $txtInterval;


        //Customer details

        $txtCustomerRef = "1234abc";

        $txtTitle = "Dr";

        $txtFirstName = "Joe";

        $txtLastName = "Bloggs";

        $txtCompany = "Bloggs Inc";

        $txtPosition = "CEO";

        $txtEmail = "joe@bloggs.com";

        $txtAddress = "10 Main St";

        $txtSuburb = "Capital City";

        $txtState = "ACT";

        $txtPostCode = "2222";

        $txtCountry = "Australia";

        $txtPhone1 = "0255559999";

        $txtPhone2 = "0299994444";

        $txtFax = "0255995599";

        $txtURL = "www.bloggs.com";

        $txtComments = "Great Product";


        //reBILL details

        $txtInvRef = "0123 - abc";

        $txtInvDesc = "reBILL XML Test Page";

        $txtCCName = "Mr J Bloggs";

        $txtCCNumber = "4444333322221111";

        $txtInitAmt = "1000";

        $txtInitDate = "25/08/2015";

        $txtRecurAmt = "500";

        $txtRecurDate = "25/08/2015";

        $txtEndDate = "25/08/2019";

        $txtewayCustomerID = "87654321";

        $txtInterval = "6";

}

function ResetFields()
{

        global $txtCustomerRef, $txtTitle, $txtFirstName, $txtLastName, $txtCompany, $txtPosition, $txtEmail, $txtFax;
        global $txtAddress, $txtSuburb, $txtState, $txtPostCode, $txtCountry, $txtPhone1, $txtPhone2, $txtURL, $txtComments;
        global $txtInvRef, $txtInvDesc, $txtCCName, $txtCCNumber, $txtInitAmt, $txtInitDate, $txtRecurAmt, $txtRecurDate;
        global $txtEndDate, $txtewayCustomerID, $txtInterval;

}

function ShowResult($lblResult, $lblErrorDescription, $lblErrorSeverity)
{
	echo'
        <div ID="pnl_Result"  Width="100%">

        <table border="0" cellpadding="0" cellspacing="0" width="60%">

     <tr>

      <td width="50%" style="height: 25px; color: white; background-color: #000000;"><b>reBILL Result</b></td>

      <td width="50%" style="height: 25px; color: white; background-color: #000000;">&nbsp;</td>

    </tr>

            <tr>

                <td style="background-color: #dcdcdc;" width="50%">

                    Result:</td>

                <td style="background-color: #dcdcdc;" width="50%">

                    <span name="lblResult" ID="lblResult">'. $lblResult.'</span></td>

            </tr>

            <tr>

                <td style="background-color: #dcdcdc;" width="50%">

                    Error Severity:</td>

                <td style="background-color: #dcdcdc;" width="50%">

                    <span ID="lblErrorSeverity" name="lblErrorSeverity">'. $lblErrorSeverity.'</span></td>

            </tr>

            <tr>

                <td style="background-color: #dcdcdc;" width="50%">
                    Error Description:</td>

                <td style="background-color: #dcdcdc;" width="50%">

                    <span ID="lblErrorDescription" name="lblErrorDescription">'. $lblErrorDescription . '</span></td>

            </tr>

    </table>

        </div>';


}

if (isset($_POST['btnSubmit'])){

require_once('RebillPayment.php');
require_once('GatewayConnector.php');
require_once('RebillResponse.php');


        $objRebill = new RebillPayment();

        $objRebill = GetRebill();



        $objConnector = new GatewayConnector();


        if ($objConnector->ProcessRequest($objRebill))

        {

            $objResponse = $objConnector->Response();


            if ($objResponse != null)

            {

                $lblResult = $objResponse->Result();


                $lblErrorDescription = $objResponse->ErrorDetails();

                $lblErrorSeverity = $objResponse->ErrorSeverity();

                ShowResult($lblResult, $lblErrorDescription, $lblErrorSeverity);

            }

        }

        else

        {


            $lblResult = "Rebill can't be uploaded. Please try again.";
            ShowResult($lblResult, "-", "-");

        }

}
else{
if (isset($_POST['btnReset'])){ResetFields();} 
else{InitialiseFields();}


?>
<html>

<head >

    <title>reBILL - XML Payment Solution</title>

</head>

<body>

    <FORM id=FORM1 name=FORM1 method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div ID="pnl_Request"  Width="100%">

  <table border="0" cellpadding="0" cellspacing="0" width="80%" style="padding-right: 1px; padding-left: 1px; padding-bottom: 1px; padding-top: 1px; position: relative; left: 0px; top: 0px;">

     <tr>

      <td colspan=2 style="color: white; height: 25px; background-color: #000000"><b style="color: white">Customer Details</b>&nbsp;</td>

      <td width="20%" style="color: white; height: 25px; background-color: #000000">&nbsp;</td>

      <td width="30%" style="color: white; height: 25px; background-color: #000000">&nbsp;</td>

    </tr>

     <tr>

      <td width="20%" style="background-color: #dcdcdc">Customer Reference Number:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" name="txtCustomerRef" ID="txtCustomerRef" value="<?php echo htmlentities($txtCustomerRef); ?>" /></td>

      <td width="20%" style="background-color: #dcdcdc">Title:</td>

      <td width="30%" style="background-color: #dcdcdc">

     <input type="Text" name="txtTitle" ID="txtTitle" value="<?php echo $txtTitle; ?>"  /></td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc">FirstName:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" name="txtFirstName" ID="txtFirstName" value="<?php echo $txtFirstName; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">LastName:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" name="txtLastName" ID="txtLastName"  value="<?php echo $txtLastName; ?>"/></td>

    </tr>

        <tr>

      <td width="20%" style="background-color: #dcdcdc">Company:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtCompany" name="txtCompany" value="<?php echo $txtCompany; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">Position:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtPosition" name="txtPosition" value="<?php echo $txtPosition; ?>"/></td>

    </tr>

      <tr>

      <td width="20%" style="background-color: #dcdcdc">Email:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtEmail" name="txtEmail" value="<?php echo $txtEmail; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">Address:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtAddress" name="txtAddress" value="<?php echo $txtAddress; ?>"/></td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc;">Suburb/City:</td>

      <td width="30%" style="background-color: #dcdcdc;">

          <input type="Text" ID="txtSuburb" name="txtSuburb" value="<?php echo $txtSuburb; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc;">State:</td>

      <td width="30%" style="background-color: #dcdcdc;">

          <input type="Text" ID="txtState" name="txtState" value="<?php echo $txtState; ?>"/></td>

    </tr>

        <tr>

      <td width="20%" style="background-color: #dcdcdc;">PostCode:</td>

      <td width="30%" style="background-color: #dcdcdc;">

          <input type="Text" ID="txtPostCode" name="txtPostCode" value="<?php echo $txtPostCode; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc;">Country:</td>

      <td width="30%" style="background-color: #dcdcdc;">

          <input type="Text" ID="txtCountry" name="txtCountry" value="<?php echo $txtCountry; ?>"/></td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc">Phone 1:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtPhone1" name="txtPhone1" value="<?php echo $txtPhone1; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">Phone 2:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtPhone2" name="txtPhone2" value="<?php echo $txtPhone2; ?>"/></td>

    </tr>

      <tr>

      <td width="20%" style="background-color: #dcdcdc">Fax:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtFax" name="txtFax" value="<?php echo $txtFax; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">URL:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtURL" name="txtURL" value="<?php echo $txtURL; ?>"/></td>

    </tr>

      <tr>

      <td width="20%" style="background-color: #dcdcdc;">Comments:</td>

      <td width="30%" style="background-color: #dcdcdc;">

          <input type="Text" ID="txtComments" name="txtComments" value="<?php echo $txtComments; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc;"></td>

      <td width="30%" style="background-color: #dcdcdc;"></td>

    </tr>

    <tr>

      <td colspan=2 style="color: white; height: 25px; background-color: #000000"><b>reBILL Details</b>&nbsp;</td>

      <td width="20%" style="color: white; height: 25px; background-color: #000000">&nbsp;</td>

      <td width="30%" style="color: white; height: 25px; background-color: #000000">&nbsp;</td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc">InvoiceRef</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtInvRef" name="txtInvRef" value="<?php echo $txtInvRef; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">InvoiceDesc</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtInvDesc" name="txtInvDesc"  value="<?php echo $txtInvDesc; ?>"/></td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc">CardHolders Name:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text"  ID="txtCCName" name="txtCCName"  value="<?php echo $txtCCName; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">Initial Amount</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtInitAmt" name="txtInitAmt"  value="<?php echo $txtInitAmt; ?>"/><br />

          cents (ie. $1 = 100)</td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc">Card Number:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtCCNumber" name="txtCCNumber"  value="<?php echo $txtCCNumber; ?>"/></td>

      <td width="20%" style="background-color: #dcdcdc">Initial Date</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtInitDate" name="txtInitDate"  value="<?php echo $txtInitDate; ?>"/></td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc">Card Expiry:</td>

      <td width="30%" style="background-color: #dcdcdc">

          <select ID="drpExpMonth" name="drpExpMonth" >
 <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>

          </select>
	<select ID="drpExpYear" name="drpExpYear">
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16" selected="selected">16</option>
          </select></td>

      <td width="20%" style="background-color: #dcdcdc">

          <span>Recurring Amount</span></td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtRecurAmt" name="txtRecurAmt"  value="<?php echo $txtRecurAmt; ?>"/><br />

          cents (ie. $1 = 100)</td>

    </tr>

    <tr>

      <td width="20%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="30%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="20%" style="background-color: #dcdcdc">

          <span>1st Recurring Date</span></td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtRecurDate" name="txtRecurDate"  value="<?php echo $txtRecurDate; ?>"/></td>

    </tr>

        <tr>

      <td width="20%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="30%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="20%" style="background-color: #dcdcdc">Interval</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtInterval" name="txtInterval"  value="<?php echo $txtInterval; ?>" Width="36px"/>&nbsp;
	
	<select ID="drpInterval" name="drpInterval" >

              <option Value="1">Days</option>

              <option Value="2">Weeks</option>

              <option Value="3">Months</option>

              <option Value="4">Years</option>

          </select></td>

    </tr>

        <tr>

      <td width="20%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="30%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="20%" style="background-color: #dcdcdc">End Date</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtEndDate" name="txtEndDate"  value="<?php echo $txtEndDate; ?>"/></td>

    </tr>

    <tr>

     <td width="20%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="30%" style="background-color: #dcdcdc">&nbsp;</td>

      <td width="20%" style="background-color: #dcdcdc">eWayCustomerID</td>

      <td width="30%" style="background-color: #dcdcdc">

          <input type="Text" ID="txtewayCustomerID" name="txtewayCustomerID"  value="<?php echo $txtewayCustomerID; ?>"/></td>

    </tr>

      <tr>

          <td align=left colspan=2 rowspan=1 style="background-color: #000000; height: 25px;">

              <input type="submit" name="btnSubmit" ID="btnSubmit" Text="Submit" value="Submit"/>
		<input type="submit" name="btnReset" ID="btnReset" Text="Reset" value="Reset" /></td>

          <td style="background-color: #000000; height: 25px;" width="20%">

          </td>

          <td style="background-color: #000000; height: 25px;" width="30%">

              </td>

      </tr>

  </table>

        </div>

</FORM>



</body>

</html>

<?php }?>
