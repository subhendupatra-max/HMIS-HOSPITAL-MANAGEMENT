<div id="message">
@if (session('success'))
<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
@endif
@if (session()->has('error'))
<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
@endif
</div>

<script>
setTimeout(function(){
  document.getElementById('message').style.display = 'none';
}, 5000);
</script>