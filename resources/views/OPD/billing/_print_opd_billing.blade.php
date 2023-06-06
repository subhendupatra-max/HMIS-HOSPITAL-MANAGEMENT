<!DOCTYPE html>
<html lang="en">

<head>
  <title> Bill Summary</title>

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
        <h1 style="text-align:center;font-size: 20px;margin: 10px 0px 10px 0px; color: #000;padding: 5px 0px 5px 0px;  width: 100%;"> Bill Summary</h1>
      </td>
    </tr>
    <table style="width: 100%;">
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
          <b>UHID No. :
            {{$opd_details->all_patient_details->patient_prefix}}/{{$opd_details->all_patient_details->id}}</b>
        </td>
        <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
          <!-- <img src="./image/qr.png" style="width: 80px;"> -->
          <?php
          $ipd_de = $opd_details->opd_prefix . '' . $opd_details->id;
          ?>

          <span style="width: 80px;height:60px">{!! QrCode::size(90)->generate($ipd_de); !!} </span>
        </td>
        <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
          <!-- <img src="./image/barcodee.png" style="width: 80px;"> -->
          @php
          $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
          @endphp

          <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('@$opd_details->opd_prefix @$opd_details->id', $generatorPNG::TYPE_CODE_128)) }}" style="width: 190px;height:60px">
        </td>
        <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
          <b>Admission Date : {{$opd_details->latest_opd_visit_details_for_patient->appointment_date}}</b>
        </td>

      </tr>
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b>
            OPD no.
            : {{$opd_details->opd_prefix}}/{{$opd_details->id}}</b></td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;">
          <b> Department:  {{$opd_details->latest_opd_visit_details_for_patient->department_details->department_name}}</b>
        </td>

      </tr>
    </table>
    <table style="width: 100%; margin: 15px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->all_patient_details->first_name}} {{$opd_details->all_patient_details->middle_name}} {{$opd_details->all_patient_details->last_name}}
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Guardian Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->all_patient_details->guardian_name}}
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Mobile No.
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->all_patient_details->phone}}
        </td>
      </tr>
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Age
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->all_patient_details->year}}Y {{$opd_details->all_patient_details->month}}M
          {{$opd_details->all_patient_details->day}}D
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Gender
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->all_patient_details->gender}}
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Type
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->latest_opd_visit_details_for_patient->patient_type}}
        </td>
      </tr>
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Dr. In Charge
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{@$opd_details->latest_opd_visit_details_for_patient->doctor->first_name}} {{@$opd_details->latest_opd_visit_details_for_patient->doctor->last_name}}
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Unit
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{@$opd_details->latest_opd_visit_details_for_patient->unit}}
        </td>
        <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Unit
        </th> -->
        <!-- <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        
        </td> -->
      </tr>
      <!-- <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Department:
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->latest_opd_visit_details_for_patient->department_details->department_name}}
        </td> -->
        <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Floor
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          3rd Floor
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Bed
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
    
        </td> -->
      <!-- </tr> -->

    </table>
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Address
        </th>
        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->all_patient_details->address}},{{$opd_details->all_patient_details->_state->name}},{{$opd_details->all_patient_details->_district->name}},{{$opd_details->all_patient_details->pin_no}}
        </td>

      </tr>
      @if($opd_details->latest_opd_visit_details_for_patient->patient_type == 'Swasthya Sathi' || $opd_details->latest_opd_visit_details_for_patient->patient_type == 'TPA' )
      <tr>
        <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          @if($opd_details->latest_opd_visit_details_for_patient->patient_type == 'Swasthya Sathi')
          Swasthya Sathi No.
          @elseif($opd_details->latest_opd_visit_details_for_patient->patient_type == 'TPA')
          TPA {{$opd_details->latest_opd_visit_details_for_patient->tpa_details->TPA_name}}
          @endif

        </th>
        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          {{$opd_details->latest_opd_visit_details_for_patient->tpa_details->type_no}}
        </td>

      </tr>
      @endif

    </table>
    <table style="width: 100%;margin:10px 0px 0px 0px">
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Date</td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Category</td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge Name
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Amount(Rs)</td>
      </tr>
      <?php $total = 0; ?>
      @if (@$patientCharges)
      @foreach ($patientCharges as $value)
      <?php $total += $value->amount; ?>
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{$loop->iteration}}
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @date('d-m-Y h:i A', strtotime($value->charges_date)) }} </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->charges_category_details->charges_catagories_name }}
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->charge_details->charges_name }}
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->amount }}
        </td>
      </tr>
      @endforeach
      @endif
    </table>
    @if (@$medicine_billings[0]->id != null)
    <table>
      <h1 style="font-size: 15px;">Medicine</h1>
    </table>
    <table style="width: 100%;">
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Medicine Bill Id</td>

        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Amount(Rs)</td>
      </tr>

      @foreach ($medicine_billings as $value)
      <?php $total += $value->amount; ?>
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{$loop->iteration}}
        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->bill_prefix }}{{ @$value->id }} </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->total_amount }}
        </td>

      </tr>
      @endforeach

    </table>
    @endif
    <table style="width: 100%;

    margin: 10px 0px 0px 0px;
    border-collapse: collapse;
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-bottom: 1px solid black;border-top: 1px solid black;">
          <tr>
            <th style="text-align: left;font-size: 13px; padding: 10px 10px 10px 10px;">
              Bill Date:
            </th>
            <td style="text-align: left;font-size: 13px;">
              {{ @date('d-m-Y h:i A', strtotime($bill->bill_date)) }} 
            </td>
    
    
            <th style="text-align: left;font-size: 13px; ">
              Total Amount:
            </th>
            <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">
             {{ @$bill->total_amount }}
            </td>
            
          </tr>
    
    
          <tr>
            <th style="text-align: left;font-size: 13px;padding: 10px 10px 10px 10px;">
              
            </th>
            <td style="text-align: left;font-size: 13px;">
           
            </td>
            @if(@$discount_details->given_discount_amount != null)
            <th style="text-align: left;font-size: 13px;">
              Discount:
            </th>
            <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">
              {{ @$discount_details->given_discount_amount }} {{ $discount_details->given_discount_type == 'Flat'?'Rs':'%' }}
            </td>
            @endif
          </tr>
          <tr>
            <th  style="text-align: left;font-size: 13px; padding: 10px 10px 10px 10px;">
              
            </th>
            <td  style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">
              
            </td>
            <th  style="text-align: left;font-size: 13px;">
              Grand Total
            </th>
            <td  style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">
              {{ @$bill->grand_total }}
            </td>
          </tr>
        </table>



    <!-- =================================================================================================== -->
</div>
</body>

</html>