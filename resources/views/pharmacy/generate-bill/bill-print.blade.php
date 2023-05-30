<!DOCTYPE html>
<html>
<title>Statement Of Marks</title>
<meta charset="utf-8">

<body>

<style>
    @page {
        size: A4 portrait;
        margin: 0;
        / change the margins as you want them to be. /
    }

    @media print {
        html, body {
          width:25cm;
          height:33cm;; 
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
        height: 33cm;;
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
      <table style="width: 100%;">
    <tr style="text-align: center;">
        <td>
            <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt="" style="width: 80%;">
        </td>
    </tr>
 </table>
     <table style="width: 100%;margin:0px 0px 15px 0px;border-collapse: collapse;">
    <tr>
   <th style="text-align: left;font-size:11px;">Bill No : {{ @$medicine_bill->bill_prefix }}{{ @$medicine_bill->id }}</th>
   <td style="text-align: right;font-size: 11px;dth:90px;padding: 0px 10px 0px 20px;font-weight: 700;">Date : {{ @date('d-m-Y H:i a',strtotime($medicine_bill->bill_date)) }}</td>
</tr>
</table>
 
 <table>
  <tr>
            <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #000;width:280px">
                <b>Patient Name:{{ @$medicine_bill->all_patient_details->prefix }} {{ @$medicine_bill->all_patient_details->first_name }} {{ @$medicine_bill->all_patient_details->middle_name }} {{ @$medicine_bill->all_patient_details->last_name }}</b>
            </td> 
            <td rowspan="2" style="text-align: center;border: 1px solid #000; width:180px">
                @php
                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                @endphp
               <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('$medicine_bill->all_patient_details->id', $generatorPNG::TYPE_CODE_128)) }}" style="width: 150px;height: 40px;">
            </td>
           
            <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border:  1px solid #000;width:272px">
                <b>Phone No : {{@$medicine_bill->all_patient_details->phone }}</b>
            </td>
           
        </tr>
        <tr>
            <td style="text-align: left;font-size: 11px; padding: 5px 10px 10px;border: 1px solid #000;"><b>UHID No: 
                {{ @$medicine_bill->all_patient_details->patient_prefix }}{{ @$medicine_bill->all_patient_details->id }}  </b></td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><b>Case Id: {{ @$medicine_bill->case_id }}</b></td>  
          
        </tr>
</table>
   <table style="width: 100%; margin-top: 10px;">
    
          <tr>
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;">Medicine Name</td>
             
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;">Batch No</td>
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;" >Price</td>
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;">Quantity</td>
              <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;">CGST(%)</td>
               <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;">SGST(%)</td>
               <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;">IGST(%)</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;font-weight: 700;">Amount(Rs)</td>
         </tr>
         @foreach ($medicine_bill_details as $value)
         <tr>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->med_nam }}({!! @$value->medicine_catagory_name !!})</td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->medicine_batch }}</td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> {!! @$value->sale_price !!} </td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{!! @$value->qty !!} {!! @$value->medicine_unit_name !!}</td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> {{ @$value->cgst }} </td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->sgst }} </td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->igst }} </td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{!! @$value->amount !!}</td>
         </tr>
         @endforeach
   </table>
     <table style="width: 100%; margin: 1px 0px 0px 0px; border-collapse: collapse;border-">
    <tr>
   <th style="text-align: left;font-size: 13px; padding: 15px 5px 0px;">Generated By: {{ @$medicine_bill->generated_by_details->first_name }} {{ @$medicine_bill->generated_by_details->last_name }}</th>
   
<tr>
   <th style="text-align: right;font-size: 13px; padding: 5px 0px 5px 0px;">Total :</th>
   <td style="text-align: right;font-size: 13px; width:90px;padding: 0px 10px 0px 0px; ">{{ @$medicine_bill->total_amount }} Rs</td>
</tr>





</table>
     </div>
   </body>
</html>