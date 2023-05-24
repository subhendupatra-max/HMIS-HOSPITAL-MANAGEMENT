

<?php $__env->startSection('content'); ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<div class="card-design">
  <div class="container-fluid">
    <div class="menubox">
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today OPD Ticket Income</h3>
          <p class="small"><?php echo e(@$opd_today_ticket_details); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/human-resources.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today OPD New Patient</h3>
          <p class="small"><?php echo e(@$opd_today_new_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/appointment.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Opd Revisit Patient</h3>
          <p class="small"><?php echo e(@$opd_today_revisit_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/registration.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Emergency Patient</h3>
          <p class="small"><?php echo e(@$today_emg_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/opd out patients.png')); ?>">
            </div>
          </div>
        </a>
      </div>

      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today EMG Income</h3>
          <p class="small"><?php echo e(@$today_emg_income); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/emergency patient.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Total Ipd Patient</h3>
          <p class="small"><?php echo e(@$total_ipd_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/emergency patient.png')); ?>">
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="menubox">
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Ipd Patients</h3>
          <p class="small"><?php echo e(@$today_total_ipd_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/ipd patients.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today IPD From OPD</h3>
          <p class="small"><?php echo e(@$today_ipd_from_opd_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/dicount.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today IPD From EMG</h3>
          <p class="small"><?php echo e(@$today_ipd_from_emg_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/pathology.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Today Discharged Patient</h3>
          <p class="small"><?php echo e(@$today_discharged_patient); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/radiology.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>IPD Income</h3>
          <p class="small"><?php echo e(@$ipd_income); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/pharmacy.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Pharmacy Income</h3>
          <p class="small"><?php echo e(@$pharmacy_income); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/pharmacy.png')); ?>">
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="menubox">
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Pathology Income</h3>
          <p class="small"><?php echo e(@$pathology_income); ?></p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/inventory.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Birth Record</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/medical-record.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Pathology</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/pathology.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Ambulance</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/ambulance.png')); ?>">
            </div>
          </div>
        </a>
      </div>
      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Font Office</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/medical-record.png')); ?>">
            </div>
          </div>
        </a>
      </div>

      <div class="menu-box1">
        <a class="card1" href="#">
          <h3>Blood Bank</h3>
          <p class="small">0</p>
          <div class="go-corner" href="#">
            <div class="go-arrow">
              <img src="<?php echo e(asset('public/assets/images/brand/blood-type.png')); ?>">
            </div>
          </div>
        </a>
      </div>
    </div>

  </div>
</div>
<div class="graph">

  <div class="row">
    <div class="col-lg-7 barbox">
      <div class="bar-graph">
        <div class="wrapper">
          <canvas id='c'></canvas>
          <div class="label">text</div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 piebox">
      <canvas width="500" id="myChart"></canvas>
    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<script>
  var ctx = document.getElementById("myChart").getContext('2d');

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["OPD", "IPD", "Pathology", "Radiology", "Pharmacy", "Refferal"],
      datasets: [{
        data: [500, 50, 1000, 100, 300, 400], // Specify the data values array

        borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896', '#e27d60', '#553d67'], // Add custom color border
        backgroundColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896', '#e27d60', '#553d67'], // Add custom color background (Points and Fill)
        borderWidth: 1 // Specify bar border width
      }]
    },

    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
    }
  });
</script>
<script>
  var label = document.querySelector(".label");
  var c = document.getElementById("c");
  var ctx = c.getContext("2d");
  var cw = c.width = 700;
  var ch = c.height = 350;
  var cx = cw / 2,
    cy = ch / 2;
  var rad = Math.PI / 180;
  var frames = 0;

  ctx.lineWidth = 1;
  ctx.strokeStyle = "#999";
  ctx.fillStyle = "#ccc";
  ctx.font = "14px monospace";

  var grd = ctx.createLinearGradient(0, 0, 0, cy);
  grd.addColorStop(0, "hsla(167,72%,60%,1)");
  grd.addColorStop(1, "hsla(167,72%,60%,0)");

  var oData = {
    "2008": 10,
    "2009": 39.9,
    "2010": 17,
    "2011": 30.0,
    "2012": 5.3,
    "2013": 38.4,
    "2014": 15.7,
    "2015": 9.0
  };

  var valuesRy = [];
  var propsRy = [];
  for (var prop in oData) {

    valuesRy.push(oData[prop]);
    propsRy.push(prop);
  }


  var vData = 4;
  var hData = valuesRy.length;
  var offset = 50.5; //offset chart axis
  var chartHeight = ch - 2 * offset;
  var chartWidth = cw - 2 * offset;
  var t = 1 / 7; // curvature : 0 = no curvature
  var speed = 2; // for the animation

  var A = {
    x: offset,
    y: offset
  }
  var B = {
    x: offset,
    y: offset + chartHeight
  }
  var C = {
    x: offset + chartWidth,
    y: offset + chartHeight
  }

  /*
      A  ^
      |  |
      + 25
      |
      |
      |
      + 25
      |__|_________________________________  C
      B
  */

  // CHART AXIS -------------------------
  ctx.beginPath();
  ctx.moveTo(A.x, A.y);
  ctx.lineTo(B.x, B.y);
  ctx.lineTo(C.x, C.y);
  ctx.stroke();

  // vertical ( A - B )
  var aStep = (chartHeight - 50) / (vData);

  var Max = Math.ceil(arrayMax(valuesRy) / 10) * 10;
  var Min = Math.floor(arrayMin(valuesRy) / 10) * 10;
  var aStepValue = (Max - Min) / (vData);
  console.log("aStepValue: " + aStepValue); //8 units
  var verticalUnit = aStep / aStepValue;

  var a = [];
  ctx.textAlign = "right";
  ctx.textBaseline = "middle";
  for (var i = 0; i <= vData; i++) {

    if (i == 0) {
      a[i] = {
        x: A.x,
        y: A.y + 25,
        val: Max
      }
    } else {
      a[i] = {}
      a[i].x = a[i - 1].x;
      a[i].y = a[i - 1].y + aStep;
      a[i].val = a[i - 1].val - aStepValue;
    }
    drawCoords(a[i], 3, 0);
  }

  //horizontal ( B - C )
  var b = [];
  ctx.textAlign = "center";
  ctx.textBaseline = "hanging";
  var bStep = chartWidth / (hData + 1);

  for (var i = 0; i < hData; i++) {
    if (i == 0) {
      b[i] = {
        x: B.x + bStep,
        y: B.y,
        val: propsRy[0]
      };
    } else {
      b[i] = {}
      b[i].x = b[i - 1].x + bStep;
      b[i].y = b[i - 1].y;
      b[i].val = propsRy[i]
    }
    drawCoords(b[i], 0, 3)
  }

  function drawCoords(o, offX, offY) {
    ctx.beginPath();
    ctx.moveTo(o.x - offX, o.y - offY);
    ctx.lineTo(o.x + offX, o.y + offY);
    ctx.stroke();

    ctx.fillText(o.val, o.x - 2 * offX, o.y + 2 * offY);
  }
  //----------------------------------------------------------

  // DATA
  var oDots = [];
  var oFlat = [];
  var i = 0;

  for (var prop in oData) {
    oDots[i] = {}
    oFlat[i] = {}

    oDots[i].x = b[i].x;
    oFlat[i].x = b[i].x;

    oDots[i].y = b[i].y - oData[prop] * verticalUnit - 25;
    oFlat[i].y = b[i].y - 25;

    oDots[i].val = oData[b[i].val];

    i++
  }



  ///// Animation Chart ///////////////////////////
  //var speed = 3;
  function animateChart() {
    requestId = window.requestAnimationFrame(animateChart);
    frames += speed; //console.log(frames)
    ctx.clearRect(60, 0, cw, ch - 60);

    for (var i = 0; i < oFlat.length; i++) {
      if (oFlat[i].y > oDots[i].y) {
        oFlat[i].y -= speed;
      }
    }
    drawCurve(oFlat);
    for (var i = 0; i < oFlat.length; i++) {
      ctx.fillText(oDots[i].val, oFlat[i].x, oFlat[i].y - 25);
      ctx.beginPath();
      ctx.arc(oFlat[i].x, oFlat[i].y, 3, 0, 2 * Math.PI);
      ctx.fill();
    }

    if (frames >= Max * verticalUnit) {
      window.cancelAnimationFrame(requestId);

    }
  }
  requestId = window.requestAnimationFrame(animateChart);

  /////// EVENTS //////////////////////
  c.addEventListener("mousemove", function(e) {
    label.innerHTML = "";
    label.style.display = "none";
    this.style.cursor = "default";

    var m = oMousePos(this, e);
    for (var i = 0; i < oDots.length; i++) {

      output(m, i);
    }

  }, false);

  function output(m, i) {
    ctx.beginPath();
    ctx.arc(oDots[i].x, oDots[i].y, 20, 0, 2 * Math.PI);
    if (ctx.isPointInPath(m.x, m.y)) {
      //console.log(i);
      label.style.display = "block";
      label.style.top = (m.y + 10) + "px";
      label.style.left = (m.x + 10) + "px";
      label.innerHTML = "<strong>" + propsRy[i] + "</strong>: " + valuesRy[i] + "%";
      c.style.cursor = "pointer";
    }
  }

  // CURVATURE
  function controlPoints(p) {
    // given the points array p calculate the control points
    var pc = [];
    for (var i = 1; i < p.length - 1; i++) {
      var dx = p[i - 1].x - p[i + 1].x; // difference x
      var dy = p[i - 1].y - p[i + 1].y; // difference y
      // the first control point
      var x1 = p[i].x - dx * t;
      var y1 = p[i].y - dy * t;
      var o1 = {
        x: x1,
        y: y1
      };

      // the second control point
      var x2 = p[i].x + dx * t;
      var y2 = p[i].y + dy * t;
      var o2 = {
        x: x2,
        y: y2
      };

      // building the control points array
      pc[i] = [];
      pc[i].push(o1);
      pc[i].push(o2);
    }
    return pc;
  }

  function drawCurve(p) {

    var pc = controlPoints(p); // the control points array

    ctx.beginPath();
    //ctx.moveTo(p[0].x, B.y- 25);
    ctx.lineTo(p[0].x, p[0].y);
    // the first & the last curve are quadratic Bezier
    // because I'm using push(), pc[i][1] comes before pc[i][0]
    ctx.quadraticCurveTo(pc[1][1].x, pc[1][1].y, p[1].x, p[1].y);

    if (p.length > 2) {
      // central curves are cubic Bezier
      for (var i = 1; i < p.length - 2; i++) {
        ctx.bezierCurveTo(pc[i][0].x, pc[i][0].y, pc[i + 1][1].x, pc[i + 1][1].y, p[i + 1].x, p[i + 1].y);
      }
      // the first & the last curve are quadratic Bezier
      var n = p.length - 1;
      ctx.quadraticCurveTo(pc[n - 1][0].x, pc[n - 1][0].y, p[n].x, p[n].y);
    }

    //ctx.lineTo(p[p.length-1].x, B.y- 25);
    ctx.stroke();
    ctx.save();
    ctx.fillStyle = grd;
    ctx.fill();
    ctx.restore();
  }

  function arrayMax(array) {
    return Math.max.apply(Math, array);
  };

  function arrayMin(array) {
    return Math.min.apply(Math, array);
  };

  function oMousePos(canvas, evt) {
    var ClientRect = canvas.getBoundingClientRect();
    return { //objeto
      x: Math.round(evt.clientX - ClientRect.left),
      y: Math.round(evt.clientY - ClientRect.top)
    }
  }
</script>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/appPages/dashboard.blade.php ENDPATH**/ ?>