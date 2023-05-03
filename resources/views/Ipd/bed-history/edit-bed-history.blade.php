







<script>
    function bedHistoryEditButton(bedHistoy_id, from_date) {
        alert(bedHistoy_id);
        alert(from_date);
        $("#bed_histry_id").val(bedHistoy_id);
        var now = new Date(from_date);
        var formattedDate = now.getFullYear() + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-' + now.getDate().toString().padStart(2, '0') + 'T' + now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

        var dateString = formattedDate.toISOString().slice(0, 16);
        //  $('#datetime-input').val(dateString);
        alert(formattedDate);

        $('#from_time').val(dateString);
        $("#editBedHistory").modal('show');

    }
</script>