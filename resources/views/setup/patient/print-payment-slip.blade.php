<!DOCTYPE html>
<html lang="en">

<head>
  <title> Payment Slip</title>

</head>
<script>
  window.print();
</script>
<style>
  @page {
    size: A4 portrait;
    margin: 0;
    / change the margins as you want them to be. /
  }

  @media print {

    html,
    body {
      width: 25cm;

      margin: 0 !important;
      padding: 5px !important;
      overflow: hidden;
    }

    .pagebreak {
      page-break-before: always;
    }

    / page-break-after works,
    as well /
  }



  body {
    font-family: sans-serif;
    background: #ffffff;
    margin: 0 auto;
    width: 100%;
  }

  table,
  th,
  td {
    border-collapse: collapse;
  }

  tr {
    width: 100%;
    height: auto;
  }
</style>
<div style="padding: 0px 7px 0px 7px;">
  <!-- ==========================================code here================================== -->
  <table style="width: 100%; border:1px soild black;border-collapse: collapse">
    <tr style="text-align: center;">
      <td>
        <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt="" style="width: 100%;">
      </td>
    </tr>
    <tr style="width:100%">
      <td style="width:100%">
        <h1
          style="text-align:center;font-size: 20px;margin: 10px 0px 10px 0px; color: #000;padding: 5px 0px 5px 0px;  width: 100%;">
          Payment Slip</h1>
      </td>
    </tr>

    <table style="width: 100%; margin: 15px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$patient_details->first_name}} {{$patient_details->middle_name}} {{$patient_details->last_name}}
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Guardian Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$patient_details->guardian_name}}
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Mobile No.
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$patient_details->phone}}
        </td>
      </tr>
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Age
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$patient_details->year}}Y {{$patient_details->month}}M
          {{$patient_details->day}}D
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Gender
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$patient_details->gender}}
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Guardian Phone No.
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$patient_details->local_guardian_contact_no }}
        </td>
      </tr>


    </table>
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Address
        </th>
        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$patient_details->address}},{{$patient_details->_state->name}},{{$patient_details->_district->name}},{{$patient_details->pin_no}}
        </td>

      </tr>


    </table>
    <table style="width: 100%;margin:10px 0px 0px 0px">
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Payment Date
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Payment Amount(₹)
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Payment Mode
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Note</td>
      </tr>

      @if (@$payment_details)
      @foreach ($payment_details as $value)

      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$loop->iteration}}
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{
          date('Y-m-d h:i A',strtotime($value->payment_date)) }}
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{
          @$value->payment_amount }}
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{
            @$value->payment_mode }}
          </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{!!
          @$value->note !!}
        </td>
      </tr>
      @endforeach
      @endif

    </table>

    <table style="width: 100%;

    margin: 10px 0px 0px 0px;
    border-collapse: collapse;
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-bottom: 1px solid black;border-top: 1px solid black;">
      <tr>
        <th style="text-align: left;font-size: 13px; padding: 10px 10px 10px 10px;">
        
        </th>
        <td style="text-align: left;font-size: 13px;">
         
        </td>
        <th style="text-align: left;font-size: 13px; ">
          Total :
        </th>
        <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;text-align:left">
          ₹{{ @$payment_amount }}
        </td>

      </tr>
    </table>



    <!-- =================================================================================================== -->
</div>
</body>

</html>