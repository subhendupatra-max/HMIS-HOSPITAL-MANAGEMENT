<!DOCTYPE html>
<html lang="en">
<head>
  <title>BillingSummary</title>
  
</head>

<style>
  @page {
      size: A4 portrait;
      margin: 0;
      / change the margins as you want them to be. /
  }

  @media print {
      html, body {
        width:25cm;
 
        margin: 0 !important; 
        padding: 5px !important;
        overflow: hidden;
      }
  }
  
    

  body 
  {
      font-family: sans-serif;
      background: #ffffff;
      margin: 0 auto;
      width:100%;
  }
  table, th, td {
     border-collapse: collapse;
}

  tr 
  {
      width: 100%;
      height: auto;
  }
 
</style>
<div style="padding: 0px 7px 0px 7px;">
<!-- ==========================================code here================================== -->
<table style="width: 100%; border:1px soild black;border-collapse: collapse">
  <tr style="text-align: center;">
      <td>
          {{-- <img src="./image/1571895010.png" style="width: 100%;"> --}}
      </td>
  </tr>
  <tr style="width:100%">
      <td style= "width:100%">
         <h1 style="text-align:center;font-size: 20px;margin: 40px 0px 20px 0px; color: #000;padding: 15px 0px 15px 0px;  width: 100%;">Billing Summary</h1>
      </td>
  </tr>
  <table style="width: 100%;">
<tr>
          <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
              <b>UHID No. : IIMSAR &DR.BCRHH/1047525</b>
          </td> 
          <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
              <img src="./image/qr.png" style="width: 80px;">
          </td>
          <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
              <img src="./image/barcodee.png" style="width: 80px;">
          </td>
          <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
              <b>Admission Date : 07/04/2023 12:50 PM</b>
          </td>
         
      </tr>
      <tr>
          <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> IPD no. : IP/IIMSAR-DR.BCRHH/23040754010   </b></td> 
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Patient Source:OPD Source Id:OPD/IIMSAR-DR.BCRHH/230407418418;</b></td>  
        
      </tr>
</table>
<table style="width: 100%; margin: 15px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
        <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              Patient Name
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        Mr.Sanjay Bhunia
          </td>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              Guardian Name
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        H/O-Debashree Bhunia
          </td>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              Mobile No.
          </th>
          <td colspan="3"  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
         7602386254
          </td>
        </tr>
        <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
            Age
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              35Y 0M 0D
          </td> 
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              Gender
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
               Male
          </td>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Type
          </th>
          <td colspan="3"style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Swasthya Sathi
          </td>
       </tr>
       <tr>
       <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
             Dr. In Charge
          </th>
          <td  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        Prof.Dr.Bidhan Roy(17)
          </td>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              Ward
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
             ENT Male
          </td>  
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              Unit
          </th>
          <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
               UNIT-1
          </td>
       </tr>
       <tr>
       <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
         Department:
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          ENT
          </td>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
            Floor
          </th>
          <td  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
       3rd Floor
          </td>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
              Bed
          </th>
          <td colspan="3"style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
             ENT-M-01-0006
          </td>  
      </tr>
      
  </table>
  <table style="width: 100%; border-collapse: collapse; ">
      <tr>
                      <th colspan="3"style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                          Address
                      </th>
                      <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                         Vill+p.o-Bhekutia Ps-Nandigram,Purba-Medinipur,west-bengal,721656
                      </td>
                       
                  </tr>
      <tr>
                      <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                         Swastya Sathi No.
                      </th>
                      <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                     19071997166295813
                      </td>
                         
                  </tr>
</table> 
<table style="width: 100%; margin: 0px 0px 0px 0px; border-collapse: collapse; border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">
  <tr>
  <th style="text-align: right;font-size: 13px; padding: 5px 0px 5px 0px;">Total :</th>
  <td style="text-align: right;font-size: 13px; width:90px;padding: 0px 10px 0px 0px; ">10000</td>
</tr>
<tr>
  <th style="text-align: right;font-size: 13px;padding: 5px 0px 5px 0px; ">Tax :</th>
  <td style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">100</td>
</tr>
<tr>
  <th style="text-align: right;font-size: 13px;padding: 5px 0px 5px 0px; ">Discount :</th>
  <td style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">50</td>
</tr>
<tr>
  <th style="text-align: right;font-size: 13px; padding: 5px 0px 5px 0px;">Grand Total :</th>
  <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">10050</td>
</tr>
</table>
<table style="width: 100%;

margin: 0px 0px 0px 0px;
border-collapse: collapse;
border-left: 1px solid black;
border-right: 1px solid black;
border-bottom: 1px solid black;">
<tr>
           <th style="text-align: left;font-size: 13px; padding: 10px 10px 10px 10px;">
              Date:
           </th>
           <td style="text-align: left;font-size: 13px;">
         17.04.2023
           </td>
           
          
           <th style="text-align: left;font-size: 13px; ">
             Payment Amount:
           </th>
           <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">
          7602386254
           </td>
        </tr>
         
        
       <tr>
           <th style="text-align: left;font-size: 13px;padding: 10px 10px 10px 10px;">
              Payment Status:
           </th>
           <td style="text-align: left;font-size: 13px;">
               Due
           </td>
           <th style="text-align: left;font-size: 13px;">
          Due:
           </th>
           <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">
        9050
           </td>
          
        </tr>
        <tr>
           <th colspan="2"style="text-align: left;font-size: 13px; padding: 10px 10px 10px 10px;">
               Paymnet Mode:
           </th>
           <td colspan="2" style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">
              Cash
           </td>
            
       </tr>
</table>
<table>
  <h1 style="font-size: 15px;">Pathology</h1>
</table>
<table style="width: 100%;">
  
  <tr>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge-Name</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Base Price</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Gst</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
 </tr>

 <tr>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
 </tr>
</table>
<table>
  <h1 style="font-size: 15px;">Radiology</h1>
</table>
<table style="width: 100%;">
  
  <tr>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge-Name</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Base Price</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Gst</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
 </tr>

 <tr>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
 </tr>
</table>
<table>
  <h1 style="font-size: 15px;">Medicine</h1>
</table>
<table style="width: 100%;">
  
  <tr>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Medicine Bill Id</td>

     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
 </tr>

 <tr>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
    
 </tr>
</table>
<table>
  <h1 style="font-size: 15px;">Others</h1>
</table>
<table style="width: 100%;">
  
  <tr>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge-Name</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Base Price</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Gst</td>
     <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
 </tr>

 <tr>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
 </tr>
</table>
  <!-- =================================================================================================== -->
</div>
</body>
</html>