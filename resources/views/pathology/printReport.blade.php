<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pathology Report</title>
  
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
        <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt="" style="width: 80%;">
      </td>
  </tr>
  <tr style="width:100%">
    <td style= "width:100%">
      <h1 style="text-align:center;font-size: 17px;margin: 5px 0px 0px 0px; color: #000;padding: 10px 0px 10px 0px;  width: 100%;">Pathology Test Report</h1>
   </td>
  </tr>
  <table style="width: 100%; margin: 0px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
    <tr>
    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Name
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        {{ @$patient_details->prefix }} {{
            @$patient_details->first_name }} {{ @$patient_details->middle_name }} {{ @$patient_details->last_name }} 
      </td>
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        Age
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        @if ($patient_details->year != 0)
        {{ @$patient_details->year }}y
        @endif
        @if ($patient_details->month != 0)
        {{ @$patient_details->month }}m
        @endif
        @if ($patient_details->day != 0)
        {{ @$patient_details->day }}d
        @endif
      </td>
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
         Sample Collected date
      </th>
      <td colspan="3"  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        1/8/2017 8:21:00AM
      </td>
    </tr>
    <tr>
    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
      UHID No.
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        {{  @$patient_details->patient_prefix }}{{ @$patient_details->id }} 
      </td> 
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Gender
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
           Male
      </td>
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
      Reported Date
      </th>
      <td colspan="3"style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        1/8/2017 8:21:00AM
      </td>
   </tr>
   <tr>
   <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        Phone No.
      </th>
      <td  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        {{ @$patient_details->phone }}
      </td>
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
         Patient type
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
       Swastya Sathi 
      </td>  
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
         Generated by
      </th>
      <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
           UNIT-1
      </td>
   </tr>
  
  
</table>
<table style="width: 100%;">
  <td style= "width:100%">
    <h4 style="text-align:center;font-size: 13px;margin: 5px 0px 0px 0px; color: #000;padding: 10px 0px 10px 0px;  width: 100%;">{{ @$pathology_patient_test_details->test_details->test_name }}<br>({{ @$pathology_patient_test_details->test_details->short_name }})</h4>
       
 </td>
</table>
<table style="width: 100%; margin: 0px 0px 0px 0px;">
  
  <tr>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">TEST NAME</th>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">VALUE</th>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">UNITS</th>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">REFERENCE RANGE</th>
    
 </tr>

 <tr>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px; border: 1px solid #000;">TOTAL LEUCOCYTES COUNT</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">8.68</td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">X 10³ / µL8.68
    </td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">4.0-10.0</td>
    
 </tr>
 <tr>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px; border: 1px solid #000;">NEUTROPHILS</td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">73.1</td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">%
  </td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">40-10</td>
  
</tr>
<tr>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px; border: 1px solid #000;">NEUTROPHILS</td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">73.1</td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">%
  </td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">40-10</td>
  
</tr>
<tr>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px; border: 1px solid #000;">NEUTROPHILS</td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">73.1</td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">%
  </td>
  <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">40-10</td>
  
</tr>
</table>

 
  <!-- =================================================================================================== -->
</div>
</body>
</html>
