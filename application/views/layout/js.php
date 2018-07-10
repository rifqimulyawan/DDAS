<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets');?>/dashboard/dist/js/bootstrap.min.js"></script>

<script src="<?php echo base_url('assets');?>/dashboard/js/chart.min.js"></script>
<script src="<?php echo base_url('assets');?>/dashboard/js/chart-data.js"></script>
<script src="<?php echo base_url('assets');?>/dashboard/js/easypiechart.js"></script>
<script src="<?php echo base_url('assets');?>/dashboard/js/easypiechart-data.js"></script>
<script src="<?php echo base_url('assets');?>/dashboard/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets');?>/dashboard/js/custom.js"></script>
<script>
  var startCharts = function () {
          var chart1 = document.getElementById("line-chart").getContext("2d");
          window.myLine = new Chart(chart1).Line(lineChartData, {
          responsive: true,
          scaleLineColor: "rgba(0,0,0,.2)",
          scaleGridLineColor: "rgba(0,0,0,.05)",
          scaleFontColor: "#c5c7cc "
          });
      }; 
  window.setTimeout(startCharts(), 1000);
</script>

<script>
  function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password" & x.name === "password") {
        x.type = "text";
    } else if (x.type === "password" & x.name === "password_lama"){
        x.type = "text";
    } else {
      x.type = "password";
    }
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo base_url('assets');?>/dashboard/ckeditor/ckeditor.js"></script>

<script>
function welcome() {
    alert("Selamat Datang, <?php echo($this->session->userdata('is_nama'))?>");
}
</script>